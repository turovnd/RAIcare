<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Clients_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Clients_Ajax extends Ajax
{
    CONST WORKING_WITH_CLIENTS = 2;

    public function before()
    {
        parent::before();
        self::hasAccess(self::WORKING_WITH_CLIENTS);
    }


    public function action_new_application()
    {
        $name           = Arr::get($_POST,'name');
        $email          = Arr::get($_POST,'email');
        $organization   = Arr::get($_POST,'organization');
        $city           = Arr::get($_POST,'city');
        $phone          = Arr::get($_POST,'phone');
        $comment        = Arr::get($_POST,'comment');

        if (empty($name)) {
            $response = new Model_Response_Clients('CLIENTS_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $client = new Model_Client();

        $client->name         = $name;
        $client->status       = 1;
        $client->email        = $email;
        $client->organization = $organization;
        $client->city         = $city;
        $client->phone        = $phone;
        $client->comment      = $comment;
        $client->created_by   = 0;

        $client->save();

        $this->send_application_request($client);

        $response = new Model_Response_Clients('CLIENTS_CREATE_SUCCESS', 'success');
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

    public function action_add()
    {
        $name           = Arr::get($_POST,'name');
        $email          = Arr::get($_POST,'email');
        $organization   = Arr::get($_POST,'organization');
        $city           = Arr::get($_POST,'city');
        $phone          = Arr::get($_POST,'phone');
        $comment        = Arr::get($_POST,'comment');

        if (empty($name)) {
            $response = new Model_Response_Clients('CLIENTS_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $client = new Model_Client();

        $client->name         = $name;
        $client->status       = 2;
        $client->email        = $email;
        $client->organization = $organization;
        $client->city         = $city;
        $client->phone        = $phone;
        $client->comment      = $comment;
        $client->created_by   = $this->user->id;

        $client = $client->save();

        $response = new Model_Response_Clients('CLIENT_ADD_SUCCESS', 'success', array('id' => $client->id));
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_changestatus()
    {
        $id     = Arr::get($_POST, 'id');
        $status = Arr::get($_POST, 'status');

        $client = new Model_Client($id);

        if (!$client->id) {
            $response = new Model_Response_Clients('CLIENT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        switch ($status) {
            case 'accept': $this->acceptApplication($client); break;
            case 'reject': $this->rejectApplication($client); break;
        }

    }

    private function acceptApplication($client)
    {
        $client->status = 2;
        $client->update();

        $response = new Model_Response_Clients('CLIENT_STATUS_ACCEPT_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    private function rejectApplication($client)
    {
        $client->status = 0;
        $client->update();

        $response = new Model_Response_Clients('CLIENT_STATUS_REJECT_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_update()
    {
        $id     = Arr::get($_POST, 'id');
        $name   = Arr::get($_POST, 'name');
        $value  = Arr::get($_POST, 'value');

        if ($name== "name" && empty($value)) {
            $response = new Model_Response_Clients('CLIENTS_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name== "email" && !Valid::email($value)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $client = new Model_Client($id);

        if (!$client->id) {
            $response = new Model_Response_Clients('CLIENT_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $client->$name = $value;
        $client->update();

        $response = new Model_Response_Clients('CLIENT_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_adduser()
    {
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
        $user->password     = $this->makeHash('md5', Methods_Translit::getUsernameByName($client->name));
        $user->role         = 10;
        $user->newsletter   = 1;
        $user->is_confirmed = 0;
        $user = $user->save();

        $client->user_id = $user->id;
        $client->update();

        $response = new Model_Response_Clients('CLIENT_USER_CREATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

}