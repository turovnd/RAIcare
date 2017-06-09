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

        $client = $client->save();

        $response = new Model_Response_Clients('CLIENT_ADD_SUCCESS', 'success', array('id' => $client->id));
        $this->response->body(@json_encode($response->get_response()));
    }


    public function action_update()
    {
        $id = Arr::get($_POST, 'id');

        //$response = new Model_Response_Application('', 'success');
        //$this->response->body(@json_encode($response->get_response()));

    }

}