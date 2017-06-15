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
    CONST MODULE_CLIENTS               = 6;
    CONST CREATE_PENSION               = 23;
    CONST WATCH_ALL_PENSIONS_PAGES     = 24;
    CONST WATCH_CREATED_PENSIONS_PAGES = 25;
    CONST EDIT_PENSION                 = 27;

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
        $pension->organization = new Model_Organization($organization);

        $pension->creator   = new Model_User($pension->creator);
        $pension->owner     = new Model_User($pension->owner);

        $data = array(
            'pension' => View::factory('pensions/blocks/list-item', array('pension'=>$pension))->render()
        );

        $response = new Model_Response_Pensions('PENSION_CREATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_update()
    {
        self::hasAccess(self::EDIT_PENSION);

        $id     = Arr::get($_POST, 'id');
        $field  = Arr::get($_POST, 'name');
        $value  = Arr::get($_POST, 'value');

        $pension = new Model_Pension($id);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($pension->$field == $value) {
            $response = new Model_Response_Pensions('PENSION_UPDATE_WARNING', 'warning');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($value)) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($field == "uri") {

            $check_org = Model_Organization::getByFieldName("uri", $value);

            if ($check_org->id) {
                $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

        }

        $pension->$field = $value;
        $pension->update();

        $response = new Model_Response_Pensions('PENSION_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_get()
    {
        $name   = Arr::get($_POST, 'name');
        $type   = Arr::get($_POST, 'type');
        $offset = Arr::get($_POST, 'offset');

        switch ($type) {
            case 'all_pensions':
                self::hasAccess(self::WATCH_ALL_PENSIONS_PAGES);
                if ($name != "") {
                    $pensions = Model_Pension::getAll($offset,10, $name);
                } else {
                    $pensions = Model_Pension::getAll($offset,10);
                }
                break;
            case 'created_pensions':
                self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGES);
                if ($name != "") {
                    $pensions = Model_Pension::getByCreator($this->user->id, $offset,10, $name);
                } else {
                    $pensions = Model_Pension::getByCreator($this->user->id,$offset,10);
                }
                break;
        }

        $html = "";
        foreach ($pensions as $pension) {
            $html .= View::factory('pensions/blocks/search-block', array('pension' => $pension))->render();
        }

        $response = new Model_Response_Pensions('PENSION_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($pensions)));
        $this->response->body(@json_encode($response->get_response()));
    }

}