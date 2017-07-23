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
    CONST WATCH_ALL_PENSIONS_PAGE        = 24;
    CONST WATCH_CREATED_PENSIONS_PAGE    = 25;
    CONST WATCH_MY_PEN_PAGE              = 26;
    CONST EDIT_PENSION                   = 27;
    CONST STATISTIC_PENSION              = 30;
    CONST AVAILABLE_PERMISSIONS_PEN      = array(27,28,29,30,31,32,36,39,40);

    public $template = 'main';
    public $pension  = null;
    public $usersIDs = null;

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => 'pen_' . $this->request->action()
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

        if ($this->request->action() == "all" ||
            $this->request->action() == 'created' ||
            $this->request->action() == 'my') {
            return;
        }

        $id = $this->request->param('id');
        $this->pension = new Model_Pension($id);

        if (!$this->pension->id)
            throw new HTTP_Exception_404();

        $this->usersIDs = Model_UserPension::getUsers($this->pension->id);

        if (!(in_array($this->user->id, $this->usersIDs) || $this->pension->creator == $this->user->id || $this->user->role == 1)) {
            throw new HTTP_Exception_403();
        }

    }


    public function action_all()
    {
        self::hasAccess(self::WATCH_ALL_PENSIONS_PAGE);

        $pensions = Model_Pension::getAll(0,10);

        $this->template->title = "Все пансионаты";
        $this->template->section = View::factory('pensions/pages/pensions')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions)
            ->set('type', 'all_pensions');
    }


    public function action_created()
    {
        self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGE);

        $pensions = Model_Pension::getByCreator($this->user->id, 0, 10);

        $this->template->title = "Созданные пансионаты";
        $this->template->section = View::factory('pensions/pages/pensions')
            ->set('title', $this->template->title)
            ->set('pensions', $pensions)
            ->set('type', 'created_pensions');
    }


    public function action_my()
    {
        self::hasAccess(self::WATCH_MY_PEN_PAGE);

        $pensionsID = Model_UserPension::getPensions($this->user->id);

        $pensions = array();

        if (!empty($pensionsID)) {
            foreach ($pensionsID as $id) {
                $pension = new Model_Pension($id);
                $pension->creator = new Model_User($pension->creator);
                $pension->owner = new Model_User($pension->owner);
                $pension->organization = new Model_Organization($pension->organization);
                $pensions[] = $pension;
            }
        }

        $this->template->title = "Мои пансионаты";
        $this->template->section = View::factory('pensions/pages/my-pensions')
            ->set('pensions', $pensions);
    }


    public function action_pension()
    {
        $users = array();
        foreach ($this->usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_PEN as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = array();
        $availableRoles = Model_Role::getByType('organization', $this->pension->id);
        foreach ($availableRoles as $role) {
            $roles[] = new Model_Role($role->id);
        }

        $this->pension->users       = $users;
        $this->pension->permissions = $permissions;
        $this->pension->roles       = $roles;

        $this->template->title = $this->pension->name;
        $this->template->section = View::factory('pensions/pages/main')
            ->set('pension', $this->pension);

    }


    public function action_settings()
    {
        $users = array();
        foreach ($this->usersIDs as $userID) {
            $user = new Model_User($userID);
            $user->role = new Model_Role($user->role);
            $users[] = $user;
        }

        $permissions = array();
        foreach (self::AVAILABLE_PERMISSIONS_PEN as $permission) {
            $permissions[] = new Model_Permission($permission);
        }

        $roles = array();
        $availableRoles = Model_Role::getByType('organization', $this->pension->id);
        foreach ($availableRoles as $role) {
            $roles[] = new Model_Role($role->id);
        }

        $this->pension->users       = $users;
        $this->pension->permissions = $permissions;
        $this->pension->roles       = $roles;

        $this->template->title = $this->pension->name;
        $this->template->section = View::factory('pensions/pages/settings')
            ->set('pension', $this->pension);

    }


    public function action_statistic()
    {
        $this->template->title = $this->pension->name;
        $this->template->section = View::factory('pensions/pages/statistic')
            ->set('pension', $this->pension);
    }

}