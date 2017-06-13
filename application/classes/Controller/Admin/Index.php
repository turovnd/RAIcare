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
    CONST MODULE_ADMIN              = 1;
    CONST ROLES_AND_PERMISSIONS     = 2;
    CONST CREATE_USERS              = 5;

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
        self::hasAccess(self::ROLES_AND_PERMISSIONS);

        $roles          = Model_Role::getAll();
        $permissions    = Model_Permission::getAll();
        $rolepermis     = Model_RolePermission::getAll() ?: [];

        $rolepermisArr = array();
        $permisArr = array();
        $permisIDArr = array();
        $tmpRoleId = null;

        foreach ($rolepermis as $key => $item) {

            $nextItem = $key < count($rolepermis) -1 ? $rolepermis[$key + 1] : null;
            $permission = new Model_Permission($item['p_id']);

            $permisArr[] = array(
                'id' => $permission->id,
                'name' => $permission->name
            );
            $permisIDArr[] = $permission->id;

            if ($item['r_id'] != $nextItem['r_id']) {
                $role = new Model_Role($item['r_id']);
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


    public function action_newuser()
    {
        self::hasAccess(self::CREATE_USERS);

        $roles = Model_Role::getAll();

        $this->template->title = "Содание пользователей";
        $this->template->section = View::factory('admin/users')
            ->set('roles', $roles);
    }

}