<?php defined('SYSPATH') or die('No direct pattern access.');

/**
 * Class Controller_Clients_Index
 *
 * @copyright RAIcare
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
            'action'    => 'clients_' .$this->request->action(),
        );

        $this->template->aside = View::factory('global-blocks/aside', $data);

    }


    public function action_new()
    {
        self::hasAccess(self::CLIENTS_REQUESTS);

        $clients = Model_Client::getClientsByStatus(1) ?: [];

        $data = array(
            'add_client'    => true,
            'reject_client' => true,
            'title'         => 'Новые клиенты',
            'empty_text'    => 'Нет новых заявок',
            'clients'       => $clients
        );

        $this->template->title = "Новые клиенты";
        $this->template->section = View::factory('clients/pages/clients-by-status', $data);
    }

    public function action_out()
    {
        $clients = Model_Client::getClientsByStatus(2) ?: [];

        $data = array(
            'add_client'    => true,
            'reject_client' => false,
            'title'         => 'Клиенты без доступа к системе',
            'empty_text'    => 'Все клиенты имеют доступ',
            'clients'       => $clients
        );

        $this->template->title = "Клиенты без доступа к системе";
        $this->template->section = View::factory('clients/pages/clients-by-status', $data);
    }

    public function action_in()
    {
        $clients = Model_Client::getClientsByStatus(3) ?: [];

        $data = array(
            'add_client'    => true,
            'reject_client' => false,
            'title'         => 'Клиенты имеющие доступ к системе',
            'empty_text'    => 'В системе нет клиентов',
            'clients'       => $clients
        );

        $this->template->title = "Клиенты имеющие доступ к системе";
        $this->template->section = View::factory('clients/pages/clients-by-status', $data);
    }

    public function action_reject()
    {
        self::hasAccess(self::CLIENTS_REQUESTS);

        $clients = Model_Client::getClientsByStatus(0) ?: [];

        $data = array(
            'add_client'    => false,
            'reject_client' => false,
            'title'         => 'Отклоненные заявки клиентов',
            'empty_text'    => 'Нет отклоненных заявок',
            'clients'       => $clients
        );

        $this->template->title = "Отклоненные заявки клиентов";
        $this->template->section = View::factory('clients/pages/clients-by-status', $data);

    }


    public function action_client()
    {
        $id = $this->request->param('id');
        $client = new Model_Client($id);

        if (!$client->id) {
            throw new HTTP_Exception_404;
        }

        if ($client->status == 1 || $client->status == 0) {
            self::hasAccess(self::CLIENTS_REQUESTS);
        }

        $client->profile = new Model_User($client->user_id);

        $this->template->title = "Клиент #" . $id;
        $this->template->section = View::factory('clients/pages/main')
                ->set('client', $client)
                ->set('organizations', $this->get_organizations($client->profile->id))
                ->set('pensions', $this->get_pensions($client->profile->id));

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


    /**
     * @param $u_id - user ID for client
     * @return array
     */
    private function get_pensions($u_id)
    {
        $pensions = array();

        $pensionsIDs = Model_UserPension::getPensions($u_id);

        if (!empty($pensionsIDs)) {
            foreach ($pensionsIDs as $id) {
                $pension = new Model_Pension($id);
                $pension->creator = new Model_User($pension->creator);
                $pension->owner = new Model_User($pension->owner);
                $pension->organization = new Model_Organization($pension->organization);
                $pensions[] = $pension;
            }
        }

        return $pensions;
    }

}