<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Pensions_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Index extends Dispatch
{
    CONST WATCH_ALL_PENSIONS_PAGES     = 24;
    CONST WATCH_CREATED_PENSIONS_PAGES = 25;
    CONST WATCH_CERTAIN_PENSIONS_PAGES = 26;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => 'pen_' . $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_all()
    {
        self::hasAccess(self::WATCH_ALL_PENSIONS_PAGES);

        $orgs = Model_Organization::getAll();
        $organizations = $this->getPensions($orgs);

        $this->template->title = "Все пансионаты";
        $this->template->section = View::factory('pensions/content')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations);
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGES);

        $orgs = Model_Organization::getCreatedByUser($this->user->id);
        $organizations = $this->getPensions($orgs);

        $this->template->title = "Созданные пансионаты";
        $this->template->section = View::factory('pensions/content')
            ->set('title', $this->template->title)
            ->set('organizations', $organizations );
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_CERTAIN_PENSIONS_PAGES);

        $organizationsID = Model_UserOrganization::getPensions($this->user->id);

        $organizations = array();

        if (!empty($organizationsID)) {
            foreach ($organizationsID as $id) {
                $organizations[] = new Model_Organization($id);
            }
        }

        $organizations = $this->getPensions($organizations);

        $this->template->title = "Мои пансионаты";
        $this->template->section = View::factory('pensions/content')
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
            $this->template->section = View::factory('pensions/pages/main')
                ->set('organization', $organization);

        } else {
            throw new HTTP_Exception_403();
        }
    }


    /**
     * @param $array - Array of Models Pensions
     * @return array - Array of Models Pensions + Models Users in `creator` and `owner`
     */
    private function getPensions($array)
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