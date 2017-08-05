<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Profiles_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Profiles_Ajax extends Ajax
{

//    /**
//     * Create user based on form in MODULE_CLIENTS
//     */
//    public function action_add()
//    {
//        self::hasAccess(self::MODULE_CLIENTS);
//        self::hasAccess(self::CREATE_USER_BASED_ON_FORM);
//
//        $id = Arr::get($_POST, 'client_id');
//
//        $client = new Model_Client($id);
//
//        if (!$client->id) {
//            $response = new Model_Response_Clients('CLIENT_DOES_NOT_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        $user = Model_User::getByFieldName('email', $client->email);
//
//        if ($user->id) {
//            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//
//        $user = new Model_User();
//
//        $password = '123';
//        /**
//         * TODO generate password
//         */
//
//        $user->name         = $client->name;
//        $user->email        = $client->email;
//        $user->username     = $this->getUserName($client->name);
//        $user->password     = $this->makeHash('md5', $password . $_SERVER['SALT']);
//        $user->role         = 2;
//        $user->creator      = $this->user->id;
//        $user->is_confirmed = 0;
//        $user = $user->save();
//
//        $client->user_id = $user->id;
//        $client->status = 3;
//        $client->update();
//
//        /**
//         * TODO send login+password to user
//         */
//
//        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success');
//        $this->response->body(@json_encode($response->get_response()));
//
//    }
//
//    /**
//     * Create user in MODULE_ADMIN
//     */
//    public function action_new()
//    {
//        self::hasAccess(self::MODULE_ADMIN);
//        self::hasAccess(self::CREATE_USER);
//
//        $name        = Arr::get($_POST, 'name');
//        $email       = Arr::get($_POST, 'email');
//        $role        = Arr::get($_POST, 'role');
//        $roleName    = Arr::get($_POST, 'roleName');
//        $permissions = json_decode(Arr::get($_POST, 'permissions'));
//
//        if ($role == "new" && count($permissions) == 0) {
//            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (empty($name) || empty($email) || ($role == "new" && empty($roleName))) {
//            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (!Valid::email($email)) {
//            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        $user = Model_User::getByFieldName('email', $email);
//
//        if ($user->id) {
//            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if ($role == "new") {
//            $role = new Model_Role();
//            $role->name = $roleName;
//            $role->type = 'admin';
//            $role->permissions = json_encode($permissions);
//            $role->type_id = 1;
//            $role = $role->save()->id;
//        }
//
//
//        $user = new Model_User();
//
//        $password = '123';
//        /**
//         * TODO generate password
//         */
//
//        $user->name         = $name;
//        $user->email        = $email;
//        $user->username     = $this->getUserName($name);
//        $user->password     = $this->makeHash('md5', $password . $_SERVER['SALT']);;
//        $user->role         = $role;
//        $user->creator      = $this->user->id;
//        $user->is_confirmed = 0;
//        $user = $user->save();
//
//        /**
//         * TODO send to email username and password
//         */
//
//        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success', array('id' => $user->id));
//        $this->response->body(@json_encode($response->get_response()));
//
//    }
//
//
//    private function getUserName($name)
//    {
//        $username = Methods_Translit::getUsernameByName($name);
//        $user = Model_User::getByFieldName('username', $username);
//        if (!empty($user->id)) {
//            $t_username = $user;
//            $counter = 0;
//            while (!empty($t_username->id)) {
//                $counter++;
//                $t_username = Model_User::getByFieldName('username', $user->username . $counter);
//            }
//            $username .= $counter;
//        }
//        return $username;
//    }
    /**
     * Update profile info
     */
    public function action_update()
    {
        $field = Arr::get($_POST, 'name');
        $value = Arr::get($_POST, 'value');

        if ($this->user->$field == $value) {
            $response = new Model_Response_Users('USER_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($this->user->id);
        $user->$field = $value;

        switch ($field) {
            case 'email':
                if (!Valid::email($value)) {
                    $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                if ($user->emptyEmail()) {
                    $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                $user->is_confirmed = 0;
                break;
            case 'username':
                if ($user->emptyUserName()) {
                    $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                break;
        }

        $user->update();

        if ($field == 'email') {
            $this->sendConfirmationLetter($user);
        }

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * Confirm email
     */
    public function action_confirmemail()
    {
        $user = new Model_User($this->user->id);

        if ($user->is_confirmed == 0) {
            $this->sendConfirmationLetter($user);
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Users('USER_CONFIRM_EMAIL_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * Update profile password
     */
    public function action_updatepassword()
    {
        $old_pass  = Arr::get($_POST, 'oldpassword');
        $new_pass  = Arr::get($_POST, 'newpassword');
        $new_pass2 = Arr::get($_POST, 'newpassword2');

        if (empty($old_pass) || empty($new_pass)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($new_pass != $new_pass2) {
            $response = new Model_Response_Users('USER_UPDATE_PASSWORD_EQUAL_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($this->user->id);

        $old_pass = $this->makeHash('md5', $old_pass . $_SERVER['SALT']);

        if (!$user->checkPassword($old_pass)) {
            $response = new Model_Response_Users('USER_UPDATE_PASSWORD_OLD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $new_pass = $this->makeHash('md5', $new_pass . $_SERVER['SALT']);
        $user->changePassword($new_pass);

        $response = new Model_Response_Users('USER_UPDATE_PASSWORD_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    private function sendConfirmationLetter($user)
    {
        $hash = $this->makeHash('sha256', $user->id . $_SERVER['SALT'] . $user->email);
        $template = View::factory('email-templates/email-confirm2', array('user' => $user, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Подтверждение электронной почты', $template, true);

        if ($email == 1) {
            $this->redis->set($_SERVER['REDIS_CONFIRMATION_HASHES'] . $hash, $user->id, array('nx', 'ex' => Date::DAY));
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }
    }

}