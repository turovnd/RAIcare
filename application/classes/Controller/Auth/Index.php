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
        $this->template->section = View::factory('welcome/pages/login')
            ->set('reset', false);
    }

    /**
     * Join page - create new application
     */
    public function action_join()
    {
        $this->template->title = "Стать клиентом";
        $this->template->section = View::factory('welcome/pages/join');
    }

    /**
     * Reset Page
     */
    public function action_reset()
    {
        $hash = $this->request->param('hash');
        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

        if (!$id) {
            $this->redirect('/login');
        }

        $this->template->section = View::factory('welcome/pages/login')
            ->set('reset', true)
            ->set('hash', $hash);

    }

    /**
     * Do logout
     */
    public function action_logout()
    {
        $auth = new Model_Auth();
        $auth->logout(TRUE);

        $this->redirect('/');
    }

}