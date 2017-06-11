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
    CONST MODULE_CLIENTS   = 6;
    CONST ADD_NEW_CLIENT   = 7;
    CONST CLIENTS_REQUESTS = 8;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::MODULE_CLIENTS);

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

        if ($client->status == 1) {
            self::hasAccess(self::CLIENTS_REQUESTS);
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
            foreach ($organizationsIDs as $id) {
                $organization = new Model_Organization($id);
                $organization->creator = new Model_User($organization->creator);
                $organization->owner = new Model_User($organization->owner);
                $organizations[] = $organization;
            }
        }

        return $organizations;
    }

}