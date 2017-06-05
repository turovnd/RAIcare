<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Applications_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Applications_Index extends Dispatch
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


    public function action_applications()
    {
        $this->template->title = "Заявки";
        $this->template->section = View::factory('applications/content');
    }

    public function action_application()
    {
        $id = $this->request->param('id');

        $this->template->title = "";
        $this->template->section = View::factory('applications/card');

    }

}