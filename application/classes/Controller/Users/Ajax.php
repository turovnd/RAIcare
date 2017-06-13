<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Users_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Users_Ajax extends Ajax
{
    CONST MODULE_ADMIN              = 1;
    CONST MODULE_CLIENTS            = 6;
    CONST MODULE_USERS              = 10;
    CONST CREATE_USER               = 5;
    CONST CREATE_USER_BASED_ON_FORM = 9;

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

        if (!$user->id) {
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
        $user->password     = $this->makeHash('md5', $password . $_SERVER['SALT']);;
        $user->role         = 10;
        $user->newsletter   = 1;
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
     * Send information to email about success creating new application
     * @param $client
     */
    private function send_application_request($client) {

        $template = View::factory('email_templates/application_request', array('name' => $client->name, 'email' => $client->email));

        $email = new Email();

        $email->send($client->email, $_SERVER['INFO_EMAIL'], 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

    }
}