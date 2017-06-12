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
    CONST MODULE_CLIENTS = 6;
    CONST CREATE_PENSION = 23;
    CONST EDIT_PENSION   = 27;

    public function action_new()
    {
        self::hasAccess(self::MODULE_CLIENTS);
        self::hasAccess(self::CREATE_PENSION);

        $name         = Arr::get($_POST,'name');
        $uri          = Arr::get($_POST,'uri');
        $cl_user      = Arr::get($_POST,'userId');
        $organization = Arr::get($_POST,'organization');

        if (empty($cl_user)) {
            $response = new Model_Response_Clients('CLIENT_USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name) || empty($uri) || empty($organization)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Pension::check_uri($uri)) {
            $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension();

        $pension->name         = $name;
        $pension->uri          = $uri;
        $pension->organization = $organization;
        $pension->is_removed   = 0;
        $pension->owner        = $cl_user;
        $pension->creator      = $this->user->id;

        $pension = $pension->save();

        Model_UserPension::add($cl_user, $pension->id);

        $pension->creator   = new Model_User($pension->creator);
        $pension->owner     = new Model_User($pension->owner);

        $data = array(
            'pension' => View::factory('pensions/blocks/card', array('pension'=>$pension))->render()
        );

        $response = new Model_Response_Pensions('PENSION_CREATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));
    }

}