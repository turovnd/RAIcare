<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Pensions_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Index extends Dispatch
{
    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    /** Current Pension */
    public $pension  = null;

    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        $pen_uri = $this->request->param('pen_uri');
        $this->pension = Model_Pension::getByFieldName('uri', $pen_uri);

        if (!$this->pension->id || $this->pension->organization != $this->organization->id) {
            throw new HTTP_Exception_404();
        }

        $this->pension->users = Model_UserPension::getUsers($this->pension->id);

        if (! ( in_array($this->user->role,self::ORG_AVAILABLE_ROLES) || $this->user->role == self::ROLE_ORG_CREATOR ||
            in_array($this->user->role,self::PEN_AVAILABLE_ROLES) || $this->user->role == self::ROLE_PEN_CREATOR) ) {

            if ( ! (in_array($this->user->id, $this->pension->users) || $this->user->role == 1) ) {
                throw new HTTP_Exception_403();
            }

        }

        $data = array(
            'aside_type' => 'pension',
            'pension'    => $this->pension,
            'action'     => $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }


//    public function action_all()
//    {
//        self::hasAccess(self::WATCH_ALL_PENSIONS_PAGE);
//
//        $pensions = Model_Pension::getAll(0,10);
//
//        $this->template->title = "Все пансионаты";
//        $this->template->section = View::factory('pensions/pages/pensions')
//            ->set('title', $this->template->title)
//            ->set('pensions', $pensions)
//            ->set('type', 'all_pensions');
//    }
//
//
//    public function action_created()
//    {
//        self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGE);
//
//        $pensions = Model_Pension::getByCreator($this->user->id, 0, 10);
//
//        $this->template->title = "Созданные пансионаты";
//        $this->template->section = View::factory('pensions/pages/pensions')
//            ->set('title', $this->template->title)
//            ->set('pensions', $pensions)
//            ->set('type', 'created_pensions');
//    }
//
//
//    public function action_my()
//    {
//        self::hasAccess(self::WATCH_MY_PEN_PAGE);
//
//        $pensionsID = Model_UserPension::getPensions($this->user->id);
//
//        $pensions = array();
//
//        if (!empty($pensionsID)) {
//            foreach ($pensionsID as $id) {
//                $pension = new Model_Pension($id);
//                $pension->creator = new Model_User($pension->creator);
//                $pension->owner = new Model_User($pension->owner);
//                $pension->organization = new Model_Organization($pension->organization);
//                $pensions[] = $pension;
//            }
//        }
//
//        $this->template->title = "Мои пансионаты";
//        $this->template->section = View::factory('pensions/pages/my-pensions')
//            ->set('pensions', $pensions);
//    }

    /**
     * Main Page Of Pension - show not private statistic for all users (co-workers from org + pen)
     */
    public function action_index()
    {
        $this->template->title = $this->pension->name;
        $this->template->section = View::factory('pensions/pages/main')
            ->set('pension', $this->pension);
    }

    /**
     * Edit Main Info about Pension - only for owner
     */
    public function action_settings()
    {
        $this->template->title = 'Настройки - ' . $this->pension->name;
        $this->template->section = View::factory('pensions/pages/settings')
            ->set('pension', $this->pension);

    }


    /**
     * Manage Co Workers Of Pension
     */
    public function action_manage()
    {
        $co_workers = array();
        foreach ($this->pension->users as $id) {
            $user = new Model_User($id);
            $user->role = new Model_Role($user->role);
            $co_workers[] = $user;
        }

        $roles = array();
        foreach (self::PEN_AVAILABLE_ROLES as $id) {
            $roles[] = new Model_Role($id);
        }

        $this->template->title = 'Сотрудники - ' . $this->pension->name;
        $this->template->section = View::factory('pensions/pages/manage')
            ->set('co_workers', $co_workers)
            ->set('roles', $roles)
            ->set('pension', $this->pension);

    }

    /**
     * Control Page
     */
    public function action_control()
    {
        $this->template->title = 'Динамика - ' . $this->pension->name;
        $this->template->section = View::factory('pensions/pages/control')
            ->set('pension', $this->pension);

    }




}