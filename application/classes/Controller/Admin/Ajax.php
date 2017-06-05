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

    /**
     * ROLE - creating new role
     */
    public function action_role_add()
    {
        $name = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role();
        $role->name = $name;
        $role = $role->save();

        $response = new Model_Response_Roles('ROLE_CREATE_SUCCESS', 'success', array('id' => $role->id));
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * ROLE - updating role
     */
    public function action_role_update()
    {
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($id)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Role($id);
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
        $id = Arr::get($_POST, 'id');

        if (empty($id)) {
            $response = new Model_Response_Roles('ROLE_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_Role::delete($id);

        $response = new Model_Response_Roles('ROLE_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * PERMISSION - creating new permission
     */
    public function action_permission_add()
    {
        $name = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Permission();
        $role->name = $name;
        $role = $role->save();

        $response = new Model_Response_Permissions('PERMISSION_CREATE_SUCCESS', 'success', array('id' => $role->id));
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * PERMISSION - updating permission
     */
    public function action_permission_update()
    {
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        if (empty($name)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($id)) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role = new Model_Permission($id);
        $role->name = $name;
        $role->update();

        $response = new Model_Response_Permissions('PERMISSION_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));


    }

    /**
     * PERMISSION - deleting permission
     */
    public function action_permission_delete()
    {
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

}