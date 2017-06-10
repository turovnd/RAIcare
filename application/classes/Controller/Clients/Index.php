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
    CONST MODULE_ID = 2;

    public $template = 'main';

    public function before()
    {
        parent::before();

        if (!self::isLogged()) {
            $this->redirect('login');
        }

        self::hasAccess(self::MODULE_ID);

        $data = array(
            'action'    => $this->request->action(),
        );

        $this->template->header = View::factory('global_blocks/header');
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

        $organizations = array();

        $organizationsIDs = Model_UserOrganization::getOrganizations($cl_user->id);

        if (!empty($organizationsIDs)) {
            foreach ($organizationsIDs as $item) {
                $organizations[] = new Model_Organization($item['organization']);
            }
        }

        $this->template->title = "Клиент " . $id;
        $this->template->section = View::factory('clients/card')
                ->set('client', $client)
                ->set('cl_user', $cl_user)
                ->set('organizations', $organizations);

    }

}