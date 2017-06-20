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
    CONST MODULE_CLIENTS              = 6;
    CONST CREATE_PENSION              = 23;
    CONST WATCH_ALL_PENSIONS_PAGE     = 24;
    CONST WATCH_CREATED_PENSIONS_PAGE = 25;
    CONST WATCH_MY_PEN_PAGE           = 26;
    CONST EDIT_PENSION                = 27;
    CONST INVITE_CO_WORKER_TO_PEN     = 28;
    CONST EXCLUDE_CO_WORKER_FROM_PEN  = 29;

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
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
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
                self::hasAccess(self::WATCH_ALL_PENSIONS_PAGE);
                if ($name != "") {
                    $pensions = Model_Pension::getAll($offset,10, $name);
                } else {
                    $pensions = Model_Pension::getAll($offset,10);
                }
                break;
            case 'created_pensions':
                self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGE);
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

    public function action_inviteuser()
    {
        $name        = Arr::get($_POST, 'name');
        $email       = Arr::get($_POST, 'email');
        $pension     = Arr::get($_POST, 'pension');
        $role        = Arr::get($_POST, 'role');
        $roleName    = Arr::get($_POST, 'roleName');
        $permissions = json_decode(Arr::get($_POST, 'permissions'));

        if ($role == "new" && count($permissions) == 0) {
            $response = new Model_Response_Permissions('PERMISSION_EMPTY_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($name) || ($role == "new" && empty($roleName))) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($pension);

        if (!$pension->id)
        {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $users = Model_UserPension::getUsers($pension->id);

        if (!in_array($this->user->id, $users) || !in_array(self::INVITE_CO_WORKER_TO_PEN, $this->user->permissions)) {
            throw new HTTP_Exception_403();
        }

        $permissions[] = strval(self::WATCH_MY_PEN_PAGE);  //each member of pension can WATCH_MY_PEN_PAGE

        if ($role == "new") {
            $role = new Model_Role();
            $role->name = $roleName;
            $role->type = 'organization';
            $role->permissions = json_encode($permissions);
            $role->type_id = $pension->id;
            $role = $role->save()->id;
        }

        /**
         * TODO send inviting email to CO-WORKER + generate link + save user DATA + role to Redis until it confirm
         */
//        $template = View::factory('email_templates/application_request', array('name' => $name, 'email' => $email));
//        $emailForm = new Email();
//        $emailForm->send($email, $_SERVER['INFO_EMAIL'], 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

        $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

    public function action_excludeuser()
    {
        $userID  = Arr::get($_POST, 'user');
        $pension = Arr::get($_POST, 'pension');

        $user = new Model_User($userID);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($pension);

        if (!$pension->id)
        {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $users = Model_UserPension::getUsers($pension->id);

        if (!in_array($this->user->id, $users) || !in_array(self::EXCLUDE_CO_WORKER_FROM_PEN, $this->user->permissions)) {
            throw new HTTP_Exception_403();
        }

        Model_UserPension::delete($user->id, $pension->id);

        /**
         * TODO send email to $user that his was deleted from pension
         */
//        $template = View::factory('email_templates/application_request', array('name' => $name, 'email' => $email));
//        $emailForm = new Email();
//        $emailForm->send($email, $_SERVER['INFO_EMAIL'], 'Заявка принята - ' . $GLOBALS['SITE_NAME'], $template, true);

        $response = new Model_Response_Pensions('PENSION_USER_DELETE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

}