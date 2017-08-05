<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Organizations_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Organizations_Index extends Dispatch
{
    /**
     * @const ACTION_LOGIN [String]
     */
    const ACTION_LOGIN = 'index';

    public $template = 'main';

    /** Current Organization */
    protected $organization = null;

    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        switch ($this->request->action()) {

            case self::ACTION_LOGIN:
                return;

            default:
                if (!self::isLogged()) self::gotoLoginPage();
        }

        if ($this->user->organization != $this->organization->id) {
            throw new HTTP_Exception_403;
        }

        $this->organization->pensions = Model_Pension::getByOrganizationID($this->organization->id, true);

        $data = array(
            'aside_type' => 'organization',
            'pensions'   => $this->organization->pensions,
            'action'     => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    /**
     * Login Page
     */
    public function action_index()
    {
        $this->template = View::factory('login')
            ->set('reset', false);
    }


    /**
     * Manage Page
     * @throws HTTP_Exception_403
     */
    public function action_manage()
    {
        if ( ! ($this->user->role == self::ROLE_ORG_CREATOR
            || $this->user->role == self::ROLE_ORG_CO_WORKER_MANAGER) ) {

            throw new HTTP_Exception_403();

        }

        $co_workers = Model_User::getAllFromOrganization($this->organization->id, true);

        foreach ($co_workers as $key => $co_worker) {
            $co_workers[$key]->role = new Model_Role($co_workers[$key]->role);
            $co_workers[$key]->pensions = Model_UserPension::getPensions($co_worker->id, true);
        }

        $roles = array();
        foreach (self::ORG_AVAILABLE_ROLES as $role) {
            array_push($roles, new Model_Role($role));
        }
        array_push($roles, new Model_Role(self::ROLE_PEN_CREATOR));
        foreach (self::PEN_AVAILABLE_ROLES as $role) {
            array_push($roles, new Model_Role($role));
        }

        $this->template->title = "Сотрудники - " . $this->organization->name;
        $this->template->section = View::factory('organizations/pages/manage')
            ->set('orgID', $this->organization->id)
            ->set('co_workers', $co_workers)
            ->set('pensions', $this->organization->pensions)
            ->set('roles', $roles)
            ->set('orgRolesID', self::ORG_AVAILABLE_ROLES );

    }


//    public function action_control_organization()
//    {
//
//    }

}