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
    CONST MODULE_USERS              = 10;
    CONST MODULE_CLIENTS            = 6;
    CONST CREATE_USER               = 5;
    CONST CREATE_USER_BASED_ON_FORM = 9;


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

        $username = Methods_Translit::getUsernameByName($client->name);
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


        $user = new Model_User();

        $user->name         = $client->name;
        $user->email        = $client->email;
        $user->username     = $username;
        $user->password     = $this->makeHash('md5', Methods_Translit::getUsernameByName($client->name) . $_SERVER['SALT']);;
        $user->role         = 10;
        $user->newsletter   = 1;
        $user->is_confirmed = 0;
        $user = $user->save();

        $client->user_id = $user->id;
        $client->update();

        $response = new Model_Response_Users('USER_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

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