<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Admin_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Admin_Index extends Dispatch
{
    public $template = 'main';

    public function before()
    {
        parent::before();

        $subdomain = Request::$subdomain;

        if (!in_array($subdomain, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        if ($this->user->role != self::ROLE_ADMIN) {
            throw new HTTP_Exception_403;
        }

        $data = array(
            'aside_type' => 'admin',
            'action'     => $this->request->action(),
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);
    }


    /**
     * @MODULE Roles
     *
     * All roles
     */
    public function action_roles() {

        $roles = Model_Role::getAll();

        $this->template->title = "Роли";
        $this->template->section = View::factory('admin/pages/roles')
            ->set('roles', $roles);
    }


    /**
     * @MODULE User
     *
     * All users
     */
    public function action_users() {

        $roles = Model_Role::getAll();
        $users = Model_User::getAll();

        $this->template->title = "Пользователи";
        $this->template->section = View::factory('admin/pages/users/all')
            ->set('users', $users)
            ->set('roles', $roles);
    }

    /**
     * @MODULE User
     *
     * Certain User
     *
     * @throws HTTP_Exception_404
     */
    public function action_user() {

        $id = $this->request->param('id');
        $user = new Model_User($id);

        if (!$user->id) throw new HTTP_Exception_404;

        $this->template->title = "Пользователь #" . $user->id;
        $this->template->section = View::factory('admin/pages/users/certain')
            ->set('user', $user);
    }

}