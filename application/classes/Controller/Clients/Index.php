<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Clients_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Clients_Index extends Dispatch
{

    public $template = 'main';


    public function before()
    {
        parent::before();

        $isLogged   = self::isLogged();

        if (!$isLogged) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->header = View::factory('global_blocks/header');
        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_clients()
    {
        $this->template->title = "Заявки";
        $this->template->section = View::factory('clients/content');
    }

    public function action_client()
    {
        $id = $this->request->param('id');

        $this->template->title = "";
        $this->template->section = View::factory('clients/card');

    }

}