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
    CONST CREATE_ORGANIZATION      = 13;
    CONST WATCH_ALL_ORGS_PAGES     = 14;
    CONST WATCH_CREATED_ORGS_PAGES = 15;
    CONST WATCH_CERTAIN_ORGS_PAGES = 16;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_all()
    {
        self::hasAccess(self::WATCH_ALL_ORGS_PAGES);

        $orgs = Model_Organization::getAll();
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Все организации";
        $this->template->section = View::factory('organizations/content')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations);
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);

        $orgs = Model_Organization::getCreatedByUser($this->user->id);
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Созданные организации";
        $this->template->section = View::factory('organizations/content')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations );
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_CERTAIN_ORGS_PAGES);

        $organizationsID = Model_UserOrganization::getOrganizations($this->user->id);

        $organizations = array();

        if (!empty($organizationsID)) {
            foreach ($organizationsID as $id) {
                $organizations[] = new Model_Organization($id);
            }
        }

        $organizations = $this->getOrganizations($organizations);

        $this->template->title = "Мои организации";
        $this->template->section = View::factory('organizations/content')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations);
    }


    public function action_organization()
    {
        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (!$organization->id)
            throw new HTTP_Exception_404();

        $users = Model_UserOrganization::getUsers($organization->id);

        if (in_array($this->user->id, $users) || $organization->creator == $this->user->id || $this->user->role == 1) {

            $this->template->title = $organization->name;
            $this->template->section = View::factory('organizations/page')
                ->set('organization', $organization);

        } else {
            throw new HTTP_Exception_403();
        }
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