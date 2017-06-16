<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Admin_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Admin_Index extends Dispatch
{
    CONST MODULE_ADMIN      = 1;
    CONST PERMISSIONS       = 2;
    CONST CREATE_USERS      = 5;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::MODULE_ADMIN);

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_rules()
    {
        self::hasAccess(self::PERMISSIONS);

        $roles = Model_Role::getByType('admin', 1);

        foreach ($roles as $role) {
            $permissions = json_decode($role->permissions);
            $role->permissions = array();
            foreach ($permissions as $permission) {
                $role->permissions[] = new Model_Permission($permission);
            }
        }

        $permissions = Model_Permission::getAll();

        $this->template->title = "Роли и права доступа";
        $this->template->section = View::factory('admin/rules')
            ->set('roles', $roles)
            ->set('permissions', $permissions);
    }


    public function action_newuser()
    {
        self::hasAccess(self::CREATE_USERS);

        $permissions = Model_Permission::getAll();
        $roles = Model_Role::getByType('admin', 1);

        $this->template->title = "Содание пользователей";
        $this->template->section = View::factory('admin/new-user')
            ->set('permissions', $permissions)
            ->set('roles', $roles);
    }

}