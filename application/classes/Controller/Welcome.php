<?php

/**
 * Class Controller_Welcome
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Welcome extends Dispatch
{
    public $template = 'welcome/main';

    function before() {
        parent::before();
    }

    /**
     * Welcome Page
     */
    public function action_index()
    {
        $this->template->title = "Добро пожаловать";
        $this->template->action = $this->request->action();
        $this->template->section = View::factory('welcome/pages/welcome');
    }

    /**
     * Software Page
     */
    public function action_software()
    {
        $this->template->title = "О системе";
        $this->template->action = $this->request->action();
        $this->template->section = View::factory('welcome/pages/software');
    }

    /**
     * Training Page
     */
    public function action_training()
    {
        $this->template->title = "Обучение";
        $this->template->action = $this->request->action();
        $this->template->section = View::factory('welcome/pages/training');
    }

    /**
     * Join Page
     */
    public function action_join()
    {
        $this->template->title = "Стать клиентом";
        $this->template->action = $this->request->action();
        $this->template->section = View::factory('welcome/pages/join');
    }

}
