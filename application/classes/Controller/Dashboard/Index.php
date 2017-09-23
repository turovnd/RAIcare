<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Dashboard_Index
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Dashboard_Index extends Dispatch
{
    public $template = 'main';

    /** Organization */
    protected $organization = null;

    public function before()
    {
        parent::before();

        $org_uri = Request::$subdomain;

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id && !in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) self::gotoLoginPage();

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (in_array($this->user->role,self::ORG_AVAILABLE_ROLES) || $this->user->role == self::ROLE_ORG_CREATOR ||
            $this->user->role == self::ROLE_ADMIN || $this->user->role == self::ROLE_DEMO) {
            $this->organization->pensions = Model_Pension::getByOrganizationID($this->organization->id, true);
        } else {
            $this->organization->pensions = Model_UserPension::getPensions($this->user->id, true);
        }

        if ($this->user->organization != $this->organization->id && $this->user->role != 1) {
            throw new HTTP_Exception_403;
        }

        $data = array(
            'aside_type'=> 'dashboard',
            'pensions'  => $this->organization->pensions,
            'action'    => 'dashboard',
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);
    }

    public function action_dashboard()
    {
        switch ($this->user->role) {
            case 1:  $page = 'dashboard-admin'; break;
            case 2:  $page = 'dashboard-demo'; break;
            case 10: $page = 'dashboard-org-10'; break;
            case 11: $page = 'dashboard-org-11'; break;
            case 12: $page = 'dashboard-org-12'; break;
            case 20: $page = 'dashboard-pen-20'; break;
            case 21: $page = 'dashboard-pen-21'; break;
            case 22: $page = 'dashboard-pen-22'; break;
            case 23: $page = 'dashboard-pen-23'; break;
        }

        $this->template->title = "Панель управления";
        $this->template->section = View::factory('dashboards/' . $page)
            ->set('organization', $this->organization);
    }

}