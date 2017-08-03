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
            throw new HTTP_Exception_400();
        }

        $this->template->title = "Сброс пароля";
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
        self::gotoLoginPage();
    }

    public function action_confirm()
    {
        $hash = $this->request->param('hash');
        $id = $this->redis->get(getenv('REDIS_CONFIRMATION_HASHES') . $hash);

        if (!$id) {
            throw new HTTP_Exception_400();
        }

        $user = new Model_User($id);
        $user->is_confirmed = 1;
        $user->update();

        $org = new Model_Organization($user->organization);

        $this->redis->delete(getenv('REDIS_CONFIRMATION_HASHES') . $hash);

        header('Location: //' . $org->uri . '.' . $_SERVER['HTTP_HOST']  . '/dashboard');
        die();
    }
}