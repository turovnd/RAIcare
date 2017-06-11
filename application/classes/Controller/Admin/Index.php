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
    CONST ADMIN_PANEL               = 1;
    CONST ROLES_AND_PERMISSIONS     = 2;
    CONST CHANGE_ORGANIZATION_OWNER = 3;
    CONST CHANGE_PENSION_OWNER      = 4;
    CONST CREATE_USERS              = 5;


    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::ADMIN_PANEL);

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_rules()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);

        $roles          = Model_Role::getAll();
        $permissions    = Model_Permission::getAll();
        $rolepermis     = Model_Rolepermis::getAll() ?: [];

        $rolepermisArr = array();
        $permisArr = array();
        $permisIDArr = array();
        $tmpRoleId = null;

        foreach ($rolepermis as $key => $item) {

            $nextItem = $key < count($rolepermis) -1 ? $rolepermis[$key + 1] : null;
            $permission = new Model_Permission($item['permission']);

            $permisArr[] = array(
                'id' => $permission->id,
                'name' => $permission->name
            );
            $permisIDArr[] = $permission->id;

            if ($item['role'] != $nextItem['role']) {
                $role = new Model_Role($item['role']);
                $rolepermisArr[] = array(
                    'roleName' => $role->name,
                    'roleId' => $role->id,
                    'json_permissions' => $permisIDArr,
                    'permission' => $permisArr
                );
                $permisArr = array();
                $permisIDArr = array();
            }

        }

        $data = array(
            'roles'         => $roles ? $roles : [],
            'permissions'   => $permissions ? $permissions : [],
            'rolepermis'    => $rolepermisArr
        );

        $this->template->title = "Роли и права доступа";
        $this->template->section = View::factory('admin/rules', $data);
    }

    public function action_orgs()
    {
        self::hasAccess(self::CHANGE_ORGANIZATION_OWNER);

        $this->template->title = "Сменить основателя организации";
        $this->template->section = View::factory('admin/organizations');
    }

    public function action_pensions()
    {
        self::hasAccess(self::CHANGE_PENSION_OWNER);

        $this->template->title = "Сменить основателя пансионата";
        $this->template->section = View::factory('admin/pension');
    }

    public function action_users()
    {
        self::hasAccess(self::CREATE_USERS);
        self::hasAccess(self::CHANGE_PENSION_OWNER);

        $this->template->title = "Содание пользователей";
        $this->template->section = View::factory('admin/users');
    }

}