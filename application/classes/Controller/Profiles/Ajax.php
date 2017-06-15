<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Profiles_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Profiles_Ajax extends Ajax
{
    CONST MODULE_ADMIN              = 1;
    CONST MODULE_CLIENTS            = 6;
    CONST MODULE_USERS              = 10;
    CONST CREATE_USER               = 5;
    CONST CREATE_USER_BASED_ON_FORM = 9;
    CONST INVITE_CO_WORKER_TO_ORG   = 18;
    CONST CHANGE_CO_WORKER_ROLE_ORG = 22;
    CONST CHANGE_CO_WORKER_ROLE_PEN = 32;
    CONST CHANGE_USER_ROLE          = 33;


    /**
     * Create user based on form in MODULE_CLIENTS
     */
    public function action_add()
    {
        self::hasAccess(self::MODULE_CLIENTS);
        self::hasAccess(self::CREATE_USER_BASED_ON_FORM);

        $id = Arr::get($_POST, 'client_id');

        $client = new Model_Client($id);

        if (!$client->id) {
            $response = new Model_Response_Clients('CLIENT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = Model_User::getByFieldName('email', $client->email);

        if ($user->id) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }


        $user = new Model_User();

        $password = '123';
        /**
         * TODO generate password
         */

        $user->name         = $client->name;
        $user->email        = $client->email;
        $user->username     = $this->getUserName($client->name);
        $user->password     = $this->makeHash('md5', $password . $_SERVER['SALT']);
        $user->role         = 10;
        $user->newsletter   = 1;
        $user->creator      = $this->user->id;
        $user->is_confirmed = 0;
        $user = $user->save();

        $client->user_id = $user->id;
        $client->status = 3;
        $client->update();

        /**
         * TODO send login+password to user
         */

        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * Create user in MODULE_ADMIN
     */
    public function action_new()
    {
        self::hasAccess(self::MODULE_ADMIN);
        self::hasAccess(self::CREATE_USER);

        $name     = Arr::get($_POST, 'name');
        $email    = Arr::get($_POST, 'email');
        $role     = Arr::get($_POST, 'role');

        if (empty($name) || empty($email) || empty($role)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = Model_User::getByFieldName('email', $email);

        if ($user->id) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User();

        $password = '123';
        /**
         * TODO generate password
         */

        $user->name         = $name;
        $user->email        = $email;
        $user->username     = $this->getUserName($name);
        $user->password     = $this->makeHash('md5', $password . $_SERVER['SALT']);;
        $user->role         = $role;
        $user->newsletter   = 1;
        $user->creator      = $this->user->id;
        $user->is_confirmed = 0;
        $user = $user->save();

        /**
         * TODO send to email username and password
         */

        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success', array('id' => $user->id));
        $this->response->body(@json_encode($response->get_response()));

    }


    private function getUserName($name)
    {
        $username = Methods_Translit::getUsernameByName($name);
        $user = Model_User::getByFieldName('username', $username);
        if (!empty($user->id)) {
            $t_username = $user;
            $counter = 0;
            while (!empty($t_username->id)) {
                $counter++;
                $t_username = Model_User::getByFieldName('username', $user->username . $counter);
            }
            $username .= $counter;
        }
        return $username;
    }


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

        switch ($field) {
            case 'email':
                if (!Valid::email($value)) {
                    $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                $user = Model_User::getByFieldName('email', $value);
                if ($user->id) {
                    $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                break;
            case 'username':
                $user = Model_User::getByFieldName('username', $value);
                if ($user->id) {
                    $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
                    $this->response->body(@json_encode($response->get_response()));
                    return;
                }
                break;
        }

        $user = new Model_User($this->user->id);
        $user->$field = $value;
        $user->update();


        if ($field == 'email') {
            /**
             * TODO send to email confirmation letter
             */
        }

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
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


    public function action_inviteuser()
    {
        $name          = Arr::get($_POST, 'name');
        $email         = Arr::get($_POST, 'email');
        $organization  = Arr::get($_POST, 'organization');

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email))
        {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($organization);

        if (!$organization->id)
        {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $users = Model_UserOrganization::getUsers($organization->id);

        if (!in_array($this->user->id, $users) || !in_array(self::INVITE_CO_WORKER_TO_ORG, $this->user->permissions)) {
            throw new HTTP_Exception_403();
        }


        /**
         * TODO send email to ORG CO-WORKER
         */
//        $template = View::factory('email_templates/application_request', array('name' => $name, 'email' => $email));
//        $emailForm = new Email();
//        $emailForm->send($email, $_SERVER['INFO_EMAIL'], 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

        $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    public function action_excludeuser()
    {
        $userID       = Arr::get($_POST, 'user');
        $organization = Arr::get($_POST, 'organization');

        $user = new Model_User($userID);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($organization);

        if (!$organization->id)
        {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Model_UserOrganization::delete($user->id, $organization->id);

        /**
         * TODO send email to $user that his was deleted from organization
         */
//        $template = View::factory('email_templates/application_request', array('name' => $name, 'email' => $email));
//        $emailForm = new Email();
//        $emailForm->send($email, $_SERVER['INFO_EMAIL'], 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

        $response = new Model_Response_Organizations('ORGANIZATION_USER_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    public function action_changerole()
    {
        $type         = Arr::get($_POST, 'type');
        $user         = Arr::get($_POST, 'user');
        $role         = Arr::get($_POST, 'role');
        $organization = Arr::get($_POST, 'organization');
        $pension      = Arr::get($_POST, 'pension');

        switch ($type) {
            case 'organization' :
                $users = Model_UserOrganization::getUsers($organization);
                if (!in_array($this->user->id, $users) || !in_array(self::CHANGE_CO_WORKER_ROLE_ORG, $this->user->permissions)) {
                    throw new HTTP_Exception_403();
                }
                break;
            case 'pension' :
                $users = Model_UserPension::getUsers($pension);
                if (!in_array($this->user->id, $users) || !in_array(self::CHANGE_CO_WORKER_ROLE_PEN, $this->user->permissions)) {
                    throw new HTTP_Exception_403();
                }
                break;
            case 'admin' :
                if (!in_array(self::CHANGE_USER_ROLE, $this->user->permissions)) {
                    throw new HTTP_Exception_403();
                }
                break;
        }

        $user = new Model_User($user);

        if (!$user->id)
        {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user->role = $role;
        $user = $user->update();

        $user->role = new Model_Role($user->role);

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success', array('role' => $user->role));
        $this->response->body(@json_encode($response->get_response()));
    }


}