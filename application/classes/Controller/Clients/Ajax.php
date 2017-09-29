<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Clients_Ajax
 *
 * @copyright RAIcare
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
        $captcha        = Arr::get($_POST, 'g-recaptcha-response');

        if (empty($name) || empty($email)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $recaptcha = new \ReCaptcha\ReCaptcha(getenv('RECAPTCHA'));

        $resp = $recaptcha->verify($captcha, $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()){
            $response = new Model_Response_Email('RECAPTCHA_ERROR', 'error');
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

        $template = View::factory('email-templates/application-request', array('name' => $client->name, 'email' => $client->email));
        $email = new Email();
        $email->send($client->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

        $response = new Model_Response_Clients('CLIENTS_APPLICATION_SEND_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

}