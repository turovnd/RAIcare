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
    CONST MODULE_USERS = 10;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::MODULE_USERS);

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }

    public function action_users()
    {
        $users = array();

        $this->template->title = "Пользователи";
        $this->template->section = View::factory('users/content')
                ->set('users', $users);

    }

}