<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Organizations_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Organizations_Index extends Dispatch
{
    CONST WATCH_ALL_ORGS_PAGES     = 14;
    CONST WATCH_CREATED_ORGS_PAGES = 15;
    CONST WATCH_MY_ORGS_PAGES      = 16;
    CONST EDIT_ORGANIZATION        = 17;
    CONST STATISTIC_ORGANIZATION   = 20;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => 'org_' . $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_all()
    {
        self::hasAccess(self::WATCH_ALL_ORGS_PAGES);

        $orgs = Model_Organization::getAll();
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Все организации";
        $this->template->section = View::factory('organizations/pages/organizations')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations);
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);

        $orgs = Model_Organization::getCreatedByUser($this->user->id);
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Созданные организации";
        $this->template->section = View::factory('organizations/pages/organizations')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations );
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_MY_ORGS_PAGES);

        $organizationsID = Model_UserOrganization::getOrganizations($this->user->id);

        $organizations = array();

        if (!empty($organizationsID)) {
            foreach ($organizationsID as $id) {
                $organizations[] = new Model_Organization($id);
            }
        }

        $organizations = $this->getOrganizations($organizations);

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

        $users = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $users) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

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

        $users = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $users) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

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

        $users = Model_UserOrganization::getUsers($organization->id);

        if (!(in_array($this->user->id, $users) || $organization->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $organization->name;
        $this->template->section = View::factory('organizations/pages/statistic')
            ->set('organization', $organization);
    }




    /**
     * @param $array - Array of Models Organizations
     * @return array - Array of Models Organizations + Models Users in `creator` and `owner`
     */
    private function getOrganizations($array)
    {
        $organizations = array();

        if (empty($array)) return $organizations;

        foreach ($array as $organization) {
            $organization->creator = new Model_User($organization->creator);
            $organization->owner = new Model_User($organization->owner);
            $organizations[] = $organization;
        }

        return $organizations;
    }



}