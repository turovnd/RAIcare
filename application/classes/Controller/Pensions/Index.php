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
    CONST EDIT_PENSION                 = 27;
    CONST STATISTIC_PENSION            = 30;

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

        $pens = Model_Pension::getAll();
        $pensions = $this->getPensions($pens);

        $this->template->title = "Все пансионаты";
        $this->template->section = View::factory('pensions/content')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions);
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGES);

        $pens = Model_Pension::getCreatedByUser($this->user->id);
        $pensions = $this->getPensions($pens);

        $this->template->title = "Созданные пансионаты";
        $this->template->section = View::factory('pensions/content')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions);
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_CERTAIN_PENSIONS_PAGES);

        $pensionsID = Model_UserPension::getPensions($this->user->id);

        $pensions = array();

        if (!empty($pensionsID)) {
            foreach ($pensionsID as $id) {
                $pensions[] = new Model_Pension($id);
            }
        }

        $pensions = $this->getPensions($pensions);

        $this->template->title = "Мои пансионаты";
        $this->template->section = View::factory('pensions/content')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions);
    }


    public function action_pension()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        $users = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $users) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/main')
            ->set('pension', $pension);

    }


    public function action_settings()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::EDIT_PENSION);

        $users = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $users) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/settings')
            ->set('pension', $pension);

    }


    public function action_statistic()
    {
        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id)
            throw new HTTP_Exception_404();

        self::hasAccess(self::STATISTIC_PENSION);

        $users = Model_UserPension::getUsers($pension->id);

        if (!(in_array($this->user->id, $users) || $pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

        $this->template->title = $pension->name;
        $this->template->section = View::factory('pensions/pages/statistic')
            ->set('pension', $pension);
    }


    /**
     * @param $array - Array of Models Pensions
     * @return array - Array of Models Pensions + Models Users in `creator` and `owner`
     */
    private function getPensions($array)
    {
        $pensions = array();

        if (empty($array)) return $pensions;

        foreach ($array as $pension) {
            $pension->creator = new Model_User($pension->creator);
            $pension->owner = new Model_User($pension->owner);
            $pensions[] = $pension;
        }

        return $pensions;
    }



}