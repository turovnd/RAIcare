<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Admin_Ajax
 *
 * @copyright RAIcare
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

        $response = new Model_Response_Permissions('PERMISSION_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

    /**
     * ROLE - updating role
     */
    public function action_role_update()
    {
        $name         = Arr::get($_POST, 'name');
        $role         = Arr::get($_POST, 'role');
        $permissions  = json_decode(Arr::get($_POST, 'permissions'));

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (count($permissions) == 0) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role($role);

        if (!$role->id) {
            $response = new Model_Response_Roles('ROLE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
        $role->name = $name;
        $role->permissions = json_encode($permissions);
        $role->update();

        $response = new Model_Response_Roles('ROLE_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

}