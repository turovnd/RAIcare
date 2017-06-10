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
    CONST WATCH_ALL_ORGS_PAGES = 3;
    CONST WATCH_CREATED_ORGS_PAGES = 4;
    CONST WATCH_CERTAIN_ORGS_PAGES = 5;

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


    public function action_organizations()
    {
        self::hasAccess(self::WATCH_ALL_ORGS_PAGES);

        $orgs = Model_Organization::getAll();
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Все организации";
        $this->template->section = View::factory('organizations/content')
                ->set('organizations', $organizations);
    }


    public function action_created_organizations()
    {
        self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);

        $orgs = Model_Organization::getCreatdByUser($this->user->id);
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Созданные организации";
        $this->template->section = View::factory('organizations/content')
            ->set('organizations', $organizations );
    }

    public function action_my_organizations()
    {
        self::hasAccess(self::WATCH_CERTAIN_ORGS_PAGES);

        $orgs = Model_UserOrganization::getOrganizations($this->user->id);
        $organizations = $this->getOrganizations($orgs);

        $this->template->title = "Мои организации";
        $this->template->section = View::factory('organizations/content')
            ->set('organizations', $organizations);
    }

    public function action_organization()
    {
        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (empty($organization->id))
            throw new HTTP_Exception_404();

        $user = Model_UserOrganization::getUser($organization->id);

        if ($organization->creator == $this->user->id)
            self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);

        if ($user == $this->user->id)
            self::hasAccess(self::WATCH_CERTAIN_ORGS_PAGES);


        $this->template->title = $organization->name;
        $this->template->section = View::factory('organizations/page')
            ->set('organization', $organization);
    }


    /**
     * @param $array - Array of organizations
     * @return array - Array of Models Organizations
     */
    private function getOrganizations($array)
    {
        $organizations = array();

        if (empty($array)) return $organizations;

        foreach ($array as $organization) {
            $organization->creator = new Model_User($organization->creator);
            $organizations[] = $organization;
        }

        return $organizations;
    }



}