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
     * Certain user
     *
     * @throws HTTP_Exception_404
     */
    public function action_user() {

        $id = $this->request->param('id');
        $user = new Model_User($id);

        if (!$user->id) throw new HTTP_Exception_404;

        $user->organization = new Model_Organization($user->organization);
        $user->pensions = Model_UserPension::getPensions($user->id, true);

        $roles = Model_Role::getAll();

        $this->template->title = "Пользователь #" . $user->id;
        $this->template->section = View::factory('admin/pages/users/certain')
            ->set('user', $user)
            ->set('roles', $roles);
    }





    /**
     * @MODULE Organization
     *
     * All organizations
     */
    public function action_organizations() {

        $organizations = Model_Organization::getAll();

        $this->template->title = "Организации";
        $this->template->section = View::factory('admin/pages/organizations/all')
            ->set('organizations', $organizations);
    }

    /**
     * @MODULE Organization
     *
     * Certain organization
     *
     * @throws HTTP_Exception_404
     */
    public function action_organization() {

        $id = $this->request->param('id');
        $organization = new Model_Organization($id);

        if (!$organization->id) throw new HTTP_Exception_404;

        $organization->owner = new Model_User($organization->owner);

        $organization->users = Model_User::getAllFromOrganization($organization->id, true);
        $organization->pensions = Model_Pension::getByOrganizationID($organization->id, true);

        $this->template->title = "Организация #" . $organization->id;
        $this->template->section = View::factory('admin/pages/organizations/certain')
            ->set('organization', $organization);
    }





    /**
     * @MODULE Pension
     *
     * All pensions
     */
    public function action_pensions() {

        $pensions = Model_Pension::getAll();

        $this->template->title = "Пансионаты";
        $this->template->section = View::factory('admin/pages/pensions/all')
            ->set('pensions', $pensions);
    }

    /**
     * @MODULE Pension
     *
     * Certain pension
     *
     * @throws HTTP_Exception_404
     */
    public function action_pension() {

        $id = $this->request->param('id');
        $pension = new Model_Pension($id);

        if (!$pension->id) throw new HTTP_Exception_404;

        $pension->organization = new Model_Organization($pension->organization);
        $pension->users = Model_UserPension::getUsers($pension->id, true);

        $this->template->title = "Пансионат #" . $pension->id;
        $this->template->section = View::factory('admin/pages/pensions/certain')
            ->set('pension', $pension);
    }


    /**
     * @MODULE Clients
     *
     * All clients
     */
    public function action_clients() {

        $clients = Model_Client::getAll();

        $this->template->title = "Клиенты";
        $this->template->section = View::factory('admin/pages/clients/all')
            ->set('clients', $clients);
    }

}