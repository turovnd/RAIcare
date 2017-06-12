<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Pensions_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Ajax extends Ajax
{
    CONST MODULE_CLIENTS       = 6;
    CONST CREATE_PENSION       = 23;

    public function action_new()
    {
        self::hasAccess(self::MODULE_CLIENTS);
        self::hasAccess(self::CREATE_PENSION);

        $name       = Arr::get($_POST,'name');
        $uri        = Arr::get($_POST,'uri');
        $cl_user    = Arr::get($_POST,'userId');

        if (empty($cl_user)) {
            $response = new Model_Response_Clients('CLIENT_USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name)) {
            $response = new Model_Response_Pensions('PENSION_EMPTY_NAME_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($uri)) {
            $response = new Model_Response_Pensions('PENSION_EMPTY_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Organization::check_uri($uri)) {
            $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Organization();

        $pension->name         = $name;
        $pension->uri          = $uri;
        $pension->is_removed   = 0;
        $pension->owner        = $cl_user;
        $pension->creator      = $this->user->id;

        $pension = $pension->save();

        Model_UserOrganization::add($cl_user, $pension->id);

        $pension->creator   = new Model_User($pension->creator);

        $data = array(
            'pension' => View::factory('pensions/blocks/card', array('pension'=>$pension))->render()
        );

        $response = new Model_Response_Pensions('PENSION_CREATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));
    }

}