<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_App_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_App_Index extends Dispatch
{

    public $template = 'app/main';


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


    public function action_dashboard()
    {
        $this->template->title = "Панель управления";
        $this->template->section = View::factory('app/pages/dashboard');
    }

}