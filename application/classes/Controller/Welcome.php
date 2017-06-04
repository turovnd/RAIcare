<?php

/**
 * Class Controller_Welcome
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Welcome extends Dispatch
{

    public $template = 'welcome/main';


    /**
     * Welcome Page
     */
    public function action_index()
    {
        $this->template->title = "Добро пожаловать";
        $this->template->section = View::factory('welcome/pages/welcome');
    }


    /**
     * Add new subscribe to DB
     */
    public function action_newsubscriber()
    {
        $this->auto_render = false;

        if (! Ajax::is_ajax()) {
            throw new HTTP_Exception_403;
        }

        $this->checkCsrf();

        $name   = Arr::get($_POST, 'name');
        $email  = Arr::get($_POST, 'email');

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $subscriber = new Model_Subscriber();
        $subscriber->name   = $name;
        $subscriber->email  = $email;

        $subscriber->save();

        $this->response->body(@json_encode("success"));

    }

}
