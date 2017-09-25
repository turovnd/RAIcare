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
     * @MODULE Roles
     *
     * Create Role
     */
    public function action_role_create() {
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
     * @MODULE Roles
     *
     * Update Role
     */
    public function action_role_update() {

        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        $role = new Model_Role($id);

        $role->name = $name;
        $role->update();

        $response = new Model_Response_Roles('ROLE_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE Roles
     *
     * Delete Role
     */
    public function action_role_delete() {

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





    /**
     * @MODULE User
     *
     * Create User
     */
    public function action_user_create() {

        $name       = Arr::get($_POST, 'name');
        $email      = Arr::get($_POST, 'email');
        $username   = Arr::get($_POST, 'username');
        $password   = Arr::get($_POST, 'password');
        $role       = Arr::get($_POST, 'role');

        if (empty($name) || empty($email) || empty($username) || empty($password) || $role == -1) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User();
        $user->name = $name;
        $user->email = $email;
        $user->username = $username;
        $user->password = $this->makeHash('md5', $password . getenv('SALT'));
        $user->role = $role;
        $user->is_confirmed = 0;
        $user->creator = $this->user->id;


        if($user->emptyEmail()) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
        if($user->emptyUserName()) {
            $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = $user->save();

        if ($role == self::ROLE_DEMO) {
            $user->organization = 1;
            $user->update();
            Model_UserPension::add($user->id, 1);
        }

        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }
}