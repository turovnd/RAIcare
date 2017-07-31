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

    /** Users that has access to $organization and their $pensions */
    protected $users = null;

    public function before()
    {
        parent::before();

        $org_uri = $this->request->param('org_uri');

        $this->organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$this->organization->id || in_array($org_uri, self::PRIVATE_SUBDOMIANS)) {
            throw new HTTP_Exception_404();
        }

        if (!self::isLogged()) {
            $this->redirect($org_uri);
        }

        $this->organization->pensions = Model_OrganizationPension::getPensions($this->organization->id, true);

        $this->users = Model_UserOrganization::getUsers($this->organization->id);

        /** add users from pensions */
        foreach ( $this->organization->pensions as $pension) {
            $users = Model_UserPension::getUsers($pension->id);
            foreach ($users as $user) {
                if (!in_array($user, $this->users)) {
                    array_push($this->users, $user);
                }
            }
        }

        if (!in_array($this->user->id, $this->users)) {
            throw new HTTP_Exception_403;
        }

        $data = array(
            'org_uri'  => $org_uri,
            'pensions'  => $this->organization->pensions,
            'action'    => 'dashboard',
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);
    }

    public function action_dashboard()
    {
        $this->template->title = "Панель управления";
        $this->template->section = View::factory('dashboard/content')
            ->set('org_uri', $this->organization->uri);
    }

}