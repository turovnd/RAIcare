<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Organizations_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Organizations_Index extends Dispatch
{
    CONST WATCH_ALL_ORGS_PAGES      = 14;
    CONST WATCH_CREATED_ORGS_PAGES  = 15;
    CONST WATCH_MY_ORGS_PAGE        = 16;
    CONST EDIT_ORGANIZATION         = 17;
    CONST STATISTIC_ORGANIZATION    = 20;
    CONST AVAILABLE_PERMISSIONS_ORG = array(17,18,19,20,21,22);

    /**
     * @const ACTION_LOGIN [String]
     */
    const ACTION_LOGIN = 'index';

    public $template = 'main';

    /** Organization */
    protected $organization = null;

    /** Users that has access to $organization */
    protected $users = null;


    public function before()
    {
        parent::before();

        $org_uri = $this->request->param('org_uri');

        switch ($this->request->action()) {

            case self::ACTION_LOGIN:
                return;

            default:
                if (!self::isLogged()) {
                    $this->redirect($org_uri);
                }
        }

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id || in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        $this->users = Model_UserOrganization::getUsers($this->organization->id);

        if (!in_array($this->user->id, $this->users)) {
            throw new HTTP_Exception_403;
        }

        $this->organization->pensions = Model_OrganizationPension::getPensions($this->organization->id);
//echo Debug::vars($this->organization->pensions);die();
        $data = array(
            'org_uri'  => $org_uri,
            'pensions'  => $this->organization->pensions,
            'action'    => 'org_' . $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }

    /**
     * Organization Page - dashboard
     */
    public function action_index()
    {
        $this->template = View::factory('organizations/pages/login');
        $this->template->section = View::factory('welcome/pages/login')
            ->set('reset', false);
    }


    /**
     * Dashboard Page
     */
    public function action_dashboard()
    {
        foreach ($this->users as $key => $userID) {
            $this->users[$key] = new Model_User($userID);
            $this->users[$key]->role = new Model_Role($this->users[$key]->role);
        }

        $this->organization->users = $this->users;

        $this->template->title = "Главная - " . $this->organization->name;
        $this->template->section = View::factory('organizations/pages/dashboard')
            ->set('organization', $this->organization);
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);

        $organizations = Model_Organization::getByCreator($this->user->id, 0, 10);

        $this->template->title = "Созданные организации";
        $this->template->section = View::factory('organizations/pages/organizations')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations )
            ->set('type', 'created_organizations');
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_MY_ORGS_PAGE);

        $organizationsID = Model_UserOrganization::getOrganizations($this->user->id);

        $organizations = array();

        if (!empty($organizationsID)) {
            foreach ($organizationsID as $id) {
                $organization = new Model_Organization($id);
                $organization->creator = new Model_User($organization->creator);
                $organization->owner = new Model_User($organization->owner);
                $organizations[] = $organization;
            }
        }

        $this->template->title = "Мои организации";
        $this->template->section = View::factory('organizations/pages/my-organizations')
            ->set('organizations', $organizations);
    }


    public function action_organization()
    {
        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (!$organization->id)
            throw new HTTP_Exception_404();

        $usersIDs = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $usersIDs) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $users = array();
        foreach ($usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $pensions = Model_Pension::getByOrganizationID($organization->id) ?: [];

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_ORG as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = array();
        $availableRoles = Model_Role::getByType('organization', $organization->id);
        foreach ($availableRoles as $role) {
            $roles[] = new Model_Role($role->id);
        }

        $organization->pensions    = $pensions;
        $organization->users       = $users;
        $organization->permissions = $permissions;
        $organization->roles       = $roles;


        $this->template->title = $organization->name;
        $this->template->section = View::factory('organizations/pages/main')
            ->set('organization', $organization);
    }


    public function action_settings()
    {
        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (!$organization->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::EDIT_ORGANIZATION);

        $usersIDs = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $usersIDs) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $users = array();
        foreach ($usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_ORG as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = Model_Role::getByType('organization', $organization->id);

        $organization->users       = $users;
        $organization->permissions = $permissions;
        $organization->roles       = $roles;

        $this->template->title = $organization->name;
        $this->template->section = View::factory('organizations/pages/settings')
            ->set('organization', $organization);

    }


    public function action_statistic()
    {
        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (!$organization->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::STATISTIC_ORGANIZATION);

        $usersIDs = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $usersIDs) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $organization->name;
        $this->template->section = View::factory('organizations/pages/statistic')
            ->set('organization', $organization);
    }


}