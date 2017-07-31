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

        $this->organization->pensions = Model_OrganizationPension::getPensions($this->organization->id, true);

        $data = array(
            'org_uri' => $org_uri,
            'pensions' => $this->organization->pensions,
            'action' => 'org_' . $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    /**
     * Login Page
     */
    public function action_index()
    {
        $this->template = View::factory('organizations/pages/login');
    }


    /**
     * Manage Page
     * - users in organization that have access to menage co-workers
     */
    public function action_manage()
    {
        if ( ! ($this->user->role == self::ROLE_ORG_CREATOR
            || $this->user->role == self::ROLE_ORG_CO_WORKER_MANAGER) ) {

            throw new HTTP_Exception_403();

        }

        $co_workers = $this->users;
        $pensions = array();

        foreach ( $this->organization->pensions as $pension) {
            $el = array('id' => $pension->id, 'name' => $pension->name);
            $pensions[] = $el;
            $users = Model_UserPension::getUsers($pension->id);
            foreach ($users as $user) {
                if (!in_array($user, $co_workers)) {
                    array_push($co_workers, $user);
                }
            }
        }

        sort($co_workers);

        foreach ($co_workers as $key => $id) {
            $co_workers[$key] = new Model_User($id);
            $co_workers[$key]->role = new Model_Role($co_workers[$key]->role);
            $co_workers[$key]->pensions = Model_UserPension::getPensions($id, true);
        }

        $roles = array();
        foreach (self::ORG_AVAILABLE_ROLES as $role) {
            array_push($roles, new Model_Role($role));
        }
        foreach (self::PEN_AVAILABLE_ROLES as $role) {
            array_push($roles, new Model_Role($role));
        }

        $this->template->title = "Сотрудники - " . $this->organization->name;
        $this->template->section = View::factory('organizations/pages/manage')
            ->set('orgID', $this->organization->id)
            ->set('co_workers', $co_workers)
            ->set('pensions', $pensions)
            ->set('roles', $roles)
            ->set('orgRolesID', self::ORG_AVAILABLE_ROLES );

    }

}