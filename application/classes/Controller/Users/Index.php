<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Users_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Users_Index extends Dispatch
{
    CONST MODULE_USERS       = 10;
    CONST WATCH_CERTAIN_USER = 11;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }

    public function action_users()
    {
        self::hasAccess(self::MODULE_USERS);

        $users = array();

        $this->template->title = "Пользователи";
        $this->template->section = View::factory('users/content')
                ->set('users', $users);

    }

    public function action_profile()
    {
        $id = $this->request->param('id');

        if (!$id) {
            $id = $this->user->id;
        } else {
            self::hasAccess(self::WATCH_CERTAIN_USER);
        }

        $user = new Model_User($id);

        if (!$user->id) {
            throw new HTTP_Exception_404;
        }

        $this->template->title = "Профиль " . $user->name;
        $this->template->section = View::factory('users/profile')
            ->set('user', $user);

    }

}