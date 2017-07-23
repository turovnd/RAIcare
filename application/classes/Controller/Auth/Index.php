<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Auth_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Auth_Index extends Dispatch
{

    public $template = 'welcome/main';


    /**
     * Authentication page
     */
    public function action_login()
    {
        $this->template->title = "Авторизация";
        $this->template->section = View::factory('welcome/pages/auth');
    }

    /**
     * Join page - create new application
     */
    public function action_join()
    {
        $this->template->title = "Стать клиентом";
        $this->template->section = View::factory('welcome/pages/join');
    }


    public function action_logout()
    {
        $auth = new Model_Auth();
        $auth->logout();
        $this->redirect('/');
    }


}