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

    /**
     * @MODULE User
     *
     * Update User
     */
    public function action_user_update() {

        $id    = Arr::get($_POST, 'id');
        $name  = Arr::get($_POST, 'name');
        $value = Arr::get($_POST, 'value');

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'email' && !Valid::email($value)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($id);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'pensions[]') {
            Model_UserPension::deleteAllPensions($user->id);

            $penIDs = array_unique(json_decode($value), SORT_STRING);
            foreach ($penIDs as $id) {
                Model_UserPension::add($user->id, $id);
            }

            goto finish;
        }

        if($name != 'password' && $user->$name == $value) {
            $response = new Model_Response_Users('USER_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if($name == 'password') {
            $value = $this->makeHash('md5', $value . getenv('SALT'));
        }

        $user->$name = $value;

        if($name == 'email' && $user->emptyEmail()) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if($name == 'username' && $user->emptyUserName()) {
            $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user->update();

        finish:

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE User
     *
     * Get User By Name
     */
    public function action_user_get() {
        $name = $this->request->query('name');
        $users = Model_User::searchByName($name);
        $this->response->body(@json_encode($users));
    }





    /**
     * @MODULE Organization
     *
     * Create Organization
     */
    public function action_organization_create() {

        $name  = Arr::get($_POST, 'name');
        $uri   = Arr::get($_POST, 'uri');
        $owner = Arr::get($_POST, 'owner');

        if (empty($name) || empty($uri) || empty($owner)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Organization::check_uri($uri)) {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization();
        $organization->name = $name;
        $organization->uri = $uri;
        $organization->owner = $owner;
        $organization->creator = $this->user->id;
        $organization->is_removed = 0;

        $organization = $organization->save();

        $user = new Model_User($owner);
        $user->organization = $organization->id;
        $user->update();

        $response = new Model_Response_Organizations('ORGANIZATION_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE Organization
     *
     * Update Organization
     */
    public function action_organization_update() {

        $id    = Arr::get($_POST, 'id');
        $name  = Arr::get($_POST, 'name');
        $value = Arr::get($_POST, 'value');

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($id);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'users[]') {
            $old_users = Model_User::getAllFromOrganization($organization->id, false);
            $cur_users = array_unique(json_decode($value), SORT_STRING);
            $del_users = array_diff($old_users, $cur_users);
            $add_users = array_diff($cur_users, $old_users);

            foreach ($del_users as $id) {
                if ($id != $organization->owner) {
                    $user = new Model_User($id);
                    $user->old_organization = $user->organization;
                    $user->organization = NULL;
                    $user->changeOrg();
                }
            }
            foreach ($add_users as $id) {
                if ($id != $organization->owner) {
                    $user = new Model_User($id);
                    $user->old_organization = $user->organization;
                    $user->organization = $organization->id;
                    $user->changeOrg();
                }
            }

            goto finish;
        }

        if($organization->$name == $value) {
            $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'uri' && Model_Organization::check_uri($value)) {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization->$name = $value;
        $organization->update();

        finish:

        $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE Organization
     *
     * Get Organizations By Name
     */
    public function action_organization_get() {
        $name = $this->request->query('name');
        $organizations = Model_Organization::searchByName($name);
        $this->response->body(@json_encode($organizations));
    }





    /**
     * @MODULE Pension
     *
     * Create Pension
     */
    public function action_pension_create() {

        $name         = Arr::get($_POST, 'name');
        $uri          = Arr::get($_POST, 'uri');
        $places       = Arr::get($_POST, 'places');
        $organization = Arr::get($_POST, 'organization');

        if (empty($name) || empty($uri) || empty($places) || empty($organization)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Pension::check_uri($uri, $organization)) {
            $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension();
        $pension->name = $name;
        $pension->uri = $uri;
        $pension->places = $places;
        $pension->organization = $organization;
        $pension->creator = $this->user->id;
        $pension->is_removed = 0;

        $pension->save();

        $response = new Model_Response_Pensions('PENSION_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE Pension
     *
     * Update Pension
     */
    public function action_pension_update() {

        $id    = Arr::get($_POST, 'id');
        $name  = Arr::get($_POST, 'name');
        $value = Arr::get($_POST, 'value');

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($id);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $users = array();

        if ($name == 'users[]') {

            Model_UserPension::deleteAllUsers($pension->id);

            $cur_users = array_unique(json_decode($value), SORT_STRING);

            foreach ($cur_users as $id) {
                $user = new Model_User($id);

                if ($user->organization == $pension->organization) {
                    Model_UserPension::add($user->id, $pension->id);
                    $users[] = $user;
                }
            }

            goto finish;
        }

        if($pension->$name == $value) {
            $response = new Model_Response_Pensions('PENSION_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'uri' && Model_Pension::check_uri($value, $pension->organization)) {
            $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension->$name = $value;
        $pension->update();

        finish:

        $response = new Model_Response_Pensions('PENSION_UPDATE_SUCCESS', 'success', array('users' => $users));
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * @MODULE Pension
     *
     * Get Pensions By Name
     */
    public function action_pension_get() {
        $name = $this->request->query('name');
        $pensions = Model_Pension::searchByName($name);
        $this->response->body(@json_encode($pensions));
    }

}