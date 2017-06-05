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

    public function action_update()
    {
        $id = Arr::get($_POST, 'id');

        //$response = new Model_Response_Application('', 'success');
        //$this->response->body(@json_encode($response->get_response()));

    }

}