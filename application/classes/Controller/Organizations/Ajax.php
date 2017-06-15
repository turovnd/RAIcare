<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Organizations_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Organizations_Ajax extends Ajax
{
    CONST MODULE_CLIENTS           = 6;
    CONST CREATE_ORGANIZATION      = 13;
    CONST WATCH_ALL_ORGS_PAGES     = 14;
    CONST WATCH_CREATED_ORGS_PAGES = 15;
    CONST EDIT_ORGANIZATION        = 17;

    public function action_new()
    {
        self::hasAccess(self::MODULE_CLIENTS);
        self::hasAccess(self::CREATE_ORGANIZATION);

        $name       = Arr::get($_POST,'name');
        $uri        = Arr::get($_POST,'uri');
        $cl_user    = Arr::get($_POST,'userId');

        if (empty($cl_user)) {
            $response = new Model_Response_Clients('CLIENT_USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name) || empty($uri)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (Model_Organization::check_uri($uri)) {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization();

        $organization->name         = $name;
        $organization->uri          = $uri;
        $organization->is_removed   = 0;
        $organization->owner        = $cl_user;
        $organization->creator      = $this->user->id;

        $organization = $organization->save();

        Model_UserOrganization::add($cl_user, $organization->id);

        $organization->creator = new Model_User($organization->creator);
        $organization->owner   = new Model_User($organization->owner);

        $data = array(
            'organization' => View::factory('organizations/blocks/list-item', array('organization'=>$organization))->render(),
            'id'           => $organization->id,
            'name'         => $organization->name
        );

        $response = new Model_Response_Organizations('ORGANIZATION_CREATE_SUCCESS', 'success', $data);
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_update()
    {
        self::hasAccess(self::EDIT_ORGANIZATION);

        $id     = Arr::get($_POST, 'id');
        $field  = Arr::get($_POST, 'name');
        $value  = Arr::get($_POST, 'value');

        $organization = new Model_Organization($id);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($organization->$field == $value) {
            $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_WARNING', 'warning');
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
                $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
                $this->response->body(@json_encode($response->get_response()));
                return;
            }

        }

        $organization->$field = $value;
        $organization->update();

        $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_get()
    {
        $name   = Arr::get($_POST, 'name');
        $type   = Arr::get($_POST, 'type');
        $offset = Arr::get($_POST, 'offset');

        switch ($type) {
            case 'all_organizations':
                self::hasAccess(self::WATCH_ALL_ORGS_PAGES);
                if ($name != "") {
                    $organizations = Model_Organization::getAll($offset,10, $name);
                } else {
                    $organizations = Model_Organization::getAll($offset,10);
                }
                break;
            case 'created_organizations':
                self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);
                if ($name != "") {
                    $organizations = Model_Organization::getByCreator($this->user->id, $offset,10, $name);
                } else {
                    $organizations = Model_Organization::getByCreator($this->user->id,$offset,10);
                }
                break;
        }

        $html = "";
        foreach ($organizations as $organization) {
            $html .= View::factory('organizations/blocks/search-block', array('organization' => $organization))->render();
        }

        $response = new Model_Response_Organizations('ORGANIZATION_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($organizations)));
        $this->response->body(@json_encode($response->get_response()));
    }

}