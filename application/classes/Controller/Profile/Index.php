<?php

/**
 * Class Controller_Profile_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */
class Controller_Profile_Index extends Dispatch
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


    public function action_index()
    {
        $id = $this->session->get('uid');

        $profile = new Model_User($id);

        $this->template->title = $this->user->name;
        $this->template->section = View::factory('profile/content')
            ->set('profile', $profile);
    }

}
