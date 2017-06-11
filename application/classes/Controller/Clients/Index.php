<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Clients_Index
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Clients_Index extends Dispatch
{
    CONST WORKING_WITH_CLIENTS = 2;
    CONST ADMIN_PANEL               = 1;
    CONST ROLES_AND_PERMISSIONS     = 2;
    CONST CHANGE_ORGANIZATION_OWNER = 3;
    CONST CHANGE_PENSION_OWNER      = 4;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::WORKING_WITH_CLIENTS);

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->aside = View::factory('global_blocks/aside', $data);

    }


    public function action_clients()
    {
        $clients = array(
            'new' => Model_Client::getClientsByStatus(1) ?: [],
            'withoutAccess' => Model_Client::getClientsByStatus(2) ?: [],
            'hasAccess' => Model_Client::getClientsByStatus(3) ?: []
        );

        $this->template->title = "Клиенты";
        $this->template->section = View::factory('clients/content')
                ->set('clients', $clients);
    }

    public function action_client()
    {
        $id = $this->request->param('id');
        $client = new Model_Client($id);

        if (!$client->id) {
            throw new HTTP_Exception_404;
        }

        $cl_user = new Model_User($client->user_id);

        $this->template->title = "Клиент " . $id;
        $this->template->section = View::factory('clients/card')
                ->set('client', $client)
                ->set('cl_user', $cl_user)
                ->set('organizations', $this->get_organizations($cl_user->id));

    }


    /**
     * @param $u_id - user ID for client
     * @return array
     */
    private function get_organizations($u_id)
    {
        $organizations = array();

        $organizationsIDs = Model_UserOrganization::getOrganizations($u_id);

        if (!empty($organizationsIDs)) {
            foreach ($organizationsIDs as $item) {
                $organization = new Model_Organization($item['organization']);
                $organization->creator = new Model_User($organization->creator);
                $organizations[] = $organization;
            }
        }

        return $organizations;
    }

}