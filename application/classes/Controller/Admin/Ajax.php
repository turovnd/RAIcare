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
    /**
     * Create Role
     */
    public function action_newrole() {
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        $role = new Model_Role($id);

        if ($role->id) {
            $response = new Model_Response_Roles('ROLE_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role->id = $id;
        $role->name = $name;
        $role->save();

        $response = new Model_Response_Roles('ROLE_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * Update Role
     */
    public function action_updaterole() {

        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        $role = new Model_Role($id);

        $role->name = $name;
        $role->update();

        $response = new Model_Response_Roles('ROLE_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * Delete Role
     */
    public function action_deleterole() {

        $id = Arr::get($_POST, 'id');

        $role = new Model_Role($id);

        if (!$role->id) {
            $response = new Model_Response_Roles('ROLE_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $role->delete();

        $response = new Model_Response_Roles('ROLE_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }
}