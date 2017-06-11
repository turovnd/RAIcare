<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Admin_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Admin_Ajax extends Ajax
{
    CONST MODULE_ADMIN              = 1;
    CONST ROLES_AND_PERMISSIONS     = 2;
    CONST CHANGE_ORGANIZATION_OWNER = 3;
    CONST CHANGE_PENSION_OWNER      = 4;

    function before()
    {
        parent::before();
        self::hasAccess(self::MODULE_ADMIN);
    }

    /**
     * ROLE - creating new role
     */
    public function action_role_add()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        if (empty($id)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role($id);

        if (!empty($role->id)) {
            $response = new Model_Response_Roles('ROLE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role();
        $role->id = $id;
        $role->name = $name;
        $role->save();

        $response = new Model_Response_Roles('ROLE_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * ROLE - updating role
     */
    public function action_role_update()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id     = Arr::get($_POST, 'id');
        $name   = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role($id);

        if (empty($role->id)) {
            $response = new Model_Response_Roles('ROLE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role->name = $name;
        $role->update();

        $response = new Model_Response_Roles('ROLE_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));


    }

    /**
     * ROLE - deleting role
     */
    public function action_role_delete()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id = Arr::get($_POST, 'id');

        if (empty($id)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_Role::delete($id);
        Model_Rolepermis::deleteAll($id);

        $response = new Model_Response_Roles('ROLE_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * PERMISSION - creating new permission
     */
    public function action_permission_add()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        if (empty($id)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $permission = new Model_Permission($id);

        if (!empty($permission->id)) {
            $response = new Model_Response_Permissions('PERMISSION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }


        $permission = new Model_Permission($id);
        $permission->id = $id;
        $permission->name = $name;
        $permission->save();

        $response = new Model_Response_Permissions('PERMISSION_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * PERMISSION - updating permission
     */
    public function action_permission_update()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id     = Arr::get($_POST, 'id');
        $name   = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $permission = new Model_Permission($id);

        if (empty($permission->id)) {
            $response = new Model_Response_Permissions('PERMISSION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $permission->name = $name;
        $permission->update();

        $response = new Model_Response_Permissions('PERMISSION_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));


    }

    /**
     * PERMISSION - deleting permission
     */
    public function action_permission_delete()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $id = Arr::get($_POST, 'id');

        if (empty($id)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_Permission::delete($id);
        Model_Rolepermis::deletePermission($id);

        $response = new Model_Response_Permissions('PERMISSION_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * ROLEPERMIS - creating new relation between role and permission
     */
    public function action_rolepermis_add()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $role = Arr::get($_POST, 'role');
        $permissions = json_decode(Arr::get($_POST, 'permissions'));

        if (empty($role)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_EMPTY_ROLE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($permissions)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_EMPTY_PERMISSION_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $rolepermis = new Model_Rolepermis($role);

        if (!empty($rolepermis->role)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_ROLE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $permissionsStr = self::getPermissionsAsString($role, $permissions);

        $role = new Model_Role($role);

        $data = array(
            'roleName' => $role->name,
            'permissionsStr' => $permissionsStr
        );

        $response = new Model_Response_Rolepermis('ROLEPERMIS_CREATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * ROLEPERMIS - updating relation between role and permission
     */
    public function action_rolepermis_update()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $role = Arr::get($_POST, 'role');
        $permissions = json_decode(Arr::get($_POST, 'permissions'));

        if (empty($role)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_EMPTY_ROLE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($permissions)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_EMPTY_PERMISSION_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_Rolepermis::deleteAll($role);

        $permissionsStr = self::getPermissionsAsString($role, $permissions);

        $role = new Model_Role($role);

        $data = array(
            'roleName' => $role->name,
            'permissionsStr' => $permissionsStr
        );

        $response = new Model_Response_Rolepermis('ROLEPERMIS_UPDATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));

    }

    /**
     * ROLEPERMIS - deleting relation between role and permission
     */
    public function action_rolepermis_delete()
    {
        self::hasAccess(self::ROLES_AND_PERMISSIONS);
        $role = Arr::get($_POST, 'role');

        if (empty($role)) {
            $response = new Model_Response_Rolepermis('ROLEPERMIS_EMPTY_ROLE_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_Rolepermis::deleteAll($role);

        $response = new Model_Response_Rolepermis('ROLEPERMIS_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }



    private static function getPermissionsAsString($role, $permissions)
    {
        $permissionsStr = '';

        foreach ($permissions as $permission) {
            $rolepermis = new Model_Rolepermis();
            $rolepermis->role = $role;
            $rolepermis->permission = $permission;
            $rolepermis->save();

            $permission = new Model_Permission($permission);
            $permissionsStr .= '<li data-permission="' . $permission->id . '">' . $permission->name . '</li>';
        }

        return $permissionsStr;
    }

}