<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Organizations_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Organizations_Ajax extends Ajax
{

//    public function action_new()
//    {
//        self::hasAccess(self::MODULE_CLIENTS);
//        self::hasAccess(self::CREATE_ORGANIZATION);
//
//        $name       = Arr::get($_POST,'name');
//        $uri        = Arr::get($_POST,'uri');
//        $cl_user    = Arr::get($_POST,'userId');
//
//        if (empty($cl_user)) {
//            $response = new Model_Response_Clients('CLIENT_USER_DOES_NOT_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (empty($name) || empty($uri)) {
//            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (Model_Organization::check_uri($uri)) {
//            $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        $organization = new Model_Organization();
//
//        $organization->name         = $name;
//        $organization->uri          = $uri;
//        $organization->is_removed   = 0;
//        $organization->owner        = $cl_user;
//        $organization->creator      = $this->user->id;
//
//        $organization = $organization->save();
//
//        $organization->creator = new Model_User($organization->creator);
//        $organization->owner   = new Model_User($organization->owner);
//
//        $data = array(
//            'organization' => View::factory('organizations/blocks/list-item', array('organization'=>$organization))->render(),
//            'id'           => $organization->id,
//            'name'         => $organization->name
//        );
//
//        $response = new Model_Response_Organizations('ORGANIZATION_CREATE_SUCCESS', 'success', $data);
//        $this->response->body(@json_encode($response->get_response()));
//    }
//
//    public function action_update()
//    {
//        self::hasAccess(self::EDIT_ORGANIZATION);
//
//        $id     = Arr::get($_POST, 'id');
//        $field  = Arr::get($_POST, 'name');
//        $value  = Arr::get($_POST, 'value');
//
//        $organization = new Model_Organization($id);
//
//        if (!$organization->id) {
//            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if ($organization->$field == $value) {
//            $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_WARNING', 'warning');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (empty($value)) {
//            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if ($field == "uri") {
//
//            $check_org = Model_Organization::getByFieldName("uri", $value);
//
//            if ($check_org->id) {
//                $response = new Model_Response_Organizations('ORGANIZATION_EXISTED_URI_ERROR', 'error');
//                $this->response->body(@json_encode($response->get_response()));
//                return;
//            }
//
//        }
//
//        $organization->$field = $value;
//        $organization->update();
//
//        $response = new Model_Response_Organizations('ORGANIZATION_UPDATE_SUCCESS', 'success');
//        $this->response->body(@json_encode($response->get_response()));
//    }
//
//    public function action_get()
//    {
//        $name   = Arr::get($_POST, 'name');
//        $type   = Arr::get($_POST, 'type');
//        $offset = Arr::get($_POST, 'offset');
//
//        switch ($type) {
//            case 'all_organizations':
//                self::hasAccess(self::WATCH_ALL_ORGS_PAGES);
//                if ($name != "") {
//                    $organizations = Model_Organization::getAll($offset,10, $name);
//                } else {
//                    $organizations = Model_Organization::getAll($offset,10);
//                }
//                break;
//            case 'created_organizations':
//                self::hasAccess(self::WATCH_CREATED_ORGS_PAGES);
//                if ($name != "") {
//                    $organizations = Model_Organization::getByCreator($this->user->id, $offset,10, $name);
//                } else {
//                    $organizations = Model_Organization::getByCreator($this->user->id,$offset,10);
//                }
//                break;
//        }
//
//        $html = "";
//        foreach ($organizations as $organization) {
//            $html .= View::factory('organizations/blocks/search-block', array('organization' => $organization))->render();
//        }
//
//        $response = new Model_Response_Organizations('ORGANIZATION_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($organizations)));
//        $this->response->body(@json_encode($response->get_response()));
//    }

    public function action_coworkerupdate()
    {
        $id    = Arr::get($_POST,'id');
        $name  = Arr::get($_POST, 'name');
        $value = Arr::get($_POST,'value');
        $orgID = Arr::get($_POST,'orgID');

        $this->checkAccessToManage($orgID);

        $user = new Model_User($id);
        $oldRole = $user->role;

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($orgID);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name != 'password') {
            $user->$name = $value;
        }

        if ($name == 'email' && !Valid::email($value)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'username' && $user->emptyUserName()) {
            $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'email' && $user->emptyEmail()) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name == 'email' || $name == 'password') {
            $password = substr(hash('md5', rand()),0,10);

            $user->is_confirmed = 0;
            $user->password = $this->makeHash('md5', $password . getenv('SALT'));

            $hash = $this->makeHash('sha256', $user->id . $_SERVER['SALT'] . $user->email);
            $template = View::factory('email-templates/email-confirm', array('profile' => $user, 'password' => $password, 'hash' => $hash));

            $email = new Email();
            $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Добро пожаловать в ' .$GLOBALS['SITE_NAME'] . '!', $template, true);

            if ($email == 1) {
                $this->redis->set($_SERVER['REDIS_CONFIRMATION_HASHES'] . $hash, $user->id, array('nx', 'ex' => Date::MONTH));
                $user->update();
                $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
            } else {
                $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
            }

            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user->update();

        if (in_array($oldRole, self::ORG_AVAILABLE_ROLES) && (in_array($user->role, self::PEN_AVAILABLE_ROLES) || $user->role = self::ROLE_PEN_CREATOR)
            || (in_array($oldRole, self::PEN_AVAILABLE_ROLES) || $user->role = self::ROLE_PEN_CREATOR) && in_array($user->role, self::ORG_AVAILABLE_ROLES)) {

            if (in_array($oldRole, self::ORG_AVAILABLE_ROLES)) {
                $pension = Model_Pension::getByOrganizationID($organization->id)[0];
                Model_UserPension::add($user->id, $pension);
            } else {
                Model_UserPension::deleteAllPensions($user->id);
            }

        }

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_coworkerpensions()
    {
        $id       = Arr::get($_POST,'id');
        $pensions = json_decode(Arr::get($_POST, 'pensions'));
        $orgID    = Arr::get($_POST,'orgID');

        $this->checkAccessToManage($orgID);

        $organization = new Model_Organization($orgID);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($id);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (empty($pensions)) {
            $response = new Model_Response_Pensions('PENSION_USER_NOT_EMPTY_PENSIONS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $orgPensions = Model_Pension::getByOrganizationID($organization->id);
        Model_UserPension::deleteAllPensions($user->id);

        foreach ($pensions as $pension) {
            if (in_array($pension, $orgPensions)) {
                Model_UserPension::add($user->id, $pension);
            }
        }

        $response = new Model_Response_Pensions('PENSION_USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_coworkerexclude()
    {
        $userID = Arr::get($_POST,'user');
        $orgID  = Arr::get($_POST,'organization');

        $this->checkAccessToManage($orgID);

        $user = new Model_User($userID);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($orgID);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $uName  = $user->name;
        $uEmail = $user->email;

        $user->delete();

        $pensions = Model_Pension::getByOrganizationID($organization->id);

        foreach ($pensions as $pension) {
            Model_UserPension::delete($user->id, $pension);
        }

        $template = View::factory('email-templates/co-worker-exclude', array('uName' => $uName, 'orgName' => $organization->name, 'ownerName' => $this->user->name));
        $email = new Email();
        $email = $email->send($uEmail, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Вас исключили из организации на сайте ' .$GLOBALS['SITE_NAME'] . '!', $template, true);

        if ($email == 1) {
            $response = new Model_Response_Organizations('ORGANIZATION_USER_DELETE_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_coworkerinvite()
    {
        $name     = Arr::get($_POST, 'name');
        $email    = Arr::get($_POST, 'email');
        $username = Arr::get($_POST, 'username');
        $role     = Arr::get($_POST, 'role');
        $pensions = Arr::get($_POST, 'pensions');
        $orgID    = Arr::get($_POST, 'orgID');

        $this->checkAccessToManage($orgID);

        if (empty($name) || empty($username)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if (!Valid::email($email)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $organization = new Model_Organization($orgID);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User();
        $user->name = $name;
        $user->email = $email;
        $user->username = $username;
        $user->role = $role;
        $user->organization = $organization->id;
        $user->is_confirmed = 0;
        $user->creator = $this->user->id;

        if ($user->emptyUserName()) {
            $response = new Model_Response_Users('USERNAME_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($user->emptyEmail()) {
            $response = new Model_Response_Users('USER_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ( (in_array($role, self::PEN_AVAILABLE_ROLES) || $role == self::ROLE_PEN_CREATOR ) && empty($pensions) ) {
            $response = new Model_Response_Organizations('ORGANIZATION_USER_INVITE_PENSION_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $password = substr(hash('md5', rand()),0,10);

        $user->password = $this->makeHash('md5', $password . getenv('SALT'));

        $user = $user->save();

        if (in_array($role, self::PEN_AVAILABLE_ROLES) || $role == self::ROLE_PEN_CREATOR ) {
            foreach ($pensions as $pension) {
                Model_UserPension::add($user->id, $pension);
            }
        }

        $hash = $this->makeHash('sha256', $user->id . $_SERVER['SALT'] . $user->email);
        $template = View::factory('email-templates/co-worker-invite', array('user' => $user, 'organization' => $organization, 'owner' => $this->user, 'password' => $password, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Вас пригласили в организацию на сайте ' .$GLOBALS['SITE_NAME'] . '!', $template, true);

        if ($email == 1) {
            $this->redis->set($_SERVER['REDIS_CONFIRMATION_HASHES'] . $hash, $user->id, array('nx', 'ex' => Date::MONTH));
            $response = new Model_Response_Organizations('ORGANIZATION_USER_INVITE_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }


    private function checkAccessToManage($orgID)
    {
        if (!($this->user->role == self::ROLE_ORG_CREATOR ||
            $this->user->role == self::ROLE_ORG_CO_WORKER_MANAGER ||
            $this->user->organization == $orgID))
        {
            throw new HTTP_Exception_403();
        }
    }
}