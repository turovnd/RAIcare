<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Pensions_Ajax
 *
 * @copyright RAIcare
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Pensions_Ajax extends Ajax
{
//    public function action_new()
//    {
//        $name         = Arr::get($_POST,'name');
//        $uri          = Arr::get($_POST,'uri');
//        $cl_user      = Arr::get($_POST,'userId');
//        $organization = Arr::get($_POST,'organization');
//
//        if (empty($cl_user)) {
//            $response = new Model_Response_Clients('CLIENT_USER_DOES_NOT_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (empty($name) || empty($uri) || empty($organization)) {
//            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if (Model_Pension::check_uri($uri)) {
//            $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        $pension = new Model_Pension();
//
//        $pension->name         = $name;
//        $pension->uri          = $uri;
//        $pension->organization = $organization;
//        $pension->is_removed   = 0;
//        $pension->owner        = $cl_user;
//        $pension->creator      = $this->user->id;
//
//        $pension = $pension->save();
//
//        Model_UserPension::add($cl_user, $pension->id);
//        $pension->organization = new Model_Organization($organization);
//
//        $pension->creator   = new Model_User($pension->creator);
//        $pension->owner     = new Model_User($pension->owner);
//
//        $data = array(
//            'pension' => View::factory('pensions/blocks/list-item', array('pension'=>$pension))->render()
//        );
//
//        $response = new Model_Response_Pensions('PENSION_CREATE_SUCCESS', 'success', $data);
//        $this->response->body(@json_encode($response->get_response()));
//    }
//
//    public function action_update()
//    {
//        $id     = Arr::get($_POST, 'id');
//        $field  = Arr::get($_POST, 'name');
//        $value  = Arr::get($_POST, 'value');
//
//        $pension = new Model_Pension($id);
//
//        if (!$pension->id) {
//            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }
//
//        if ($pension->$field == $value) {
//            $response = new Model_Response_Pensions('PENSION_UPDATE_WARNING', 'warning');
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
//            if ($pension->isEmptyURI($value, $pension->organization)) {
//                $response = new Model_Response_Pensions('PENSION_EXISTED_URI_ERROR', 'error');
//                $this->response->body(@json_encode($response->get_response()));
//                return;
//            }
//
//        }
//
//        $pension->$field = $value;
//        $pension->update();
//
//        $response = new Model_Response_Pensions('PENSION_UPDATE_SUCCESS', 'success');
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
//            case 'all_pensions':
//                self::hasAccess(self::WATCH_ALL_PENSIONS_PAGE);
//                if ($name != "") {
//                    $pensions = Model_Pension::getAll($offset,10, $name);
//                } else {
//                    $pensions = Model_Pension::getAll($offset,10);
//                }
//                break;
//            case 'created_pensions':
//                self::hasAccess(self::WATCH_CREATED_PENSIONS_PAGE);
//                if ($name != "") {
//                    $pensions = Model_Pension::getByCreator($this->user->id, $offset,10, $name);
//                } else {
//                    $pensions = Model_Pension::getByCreator($this->user->id,$offset,10);
//                }
//                break;
//        }
//
//        $html = "";
//        foreach ($pensions as $pension) {
//            $html .= View::factory('pensions/blocks/search-block', array('pension' => $pension))->render();
//        }
//
//        $response = new Model_Response_Pensions('PENSION_GET_SUCCESS', 'success', array('html'=>$html, 'number'=>count($pensions)));
//        $this->response->body(@json_encode($response->get_response()));
//    }

    public function action_coworkerupdate()
    {
        $id    = Arr::get($_POST,'id');
        $name  = Arr::get($_POST, 'name');
        $value = Arr::get($_POST,'value');
        $penID = Arr::get($_POST,'penID');

        $org_uri = Request::$subdomain;
        $organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->checkAccessToManage($organization->id);

        if ($name == 'email' && !Valid::email($value)) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($id);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($penID);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($name != 'password') {
            $user->$name = $value;
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
            $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Добро пожаловать в ' . $GLOBALS['SITE_NAME'] . '!', $template, true);

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

        $response = new Model_Response_Users('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    public function action_coworkerexclude()
    {
        $userID = Arr::get($_POST,'user');
        $penID  = Arr::get($_POST,'penID');

        $org_uri = Request::$subdomain;
        $organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->checkAccessToManage($organization->id);

        $user = new Model_User($userID);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $pension = new Model_Pension($penID);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $uName  = $user->name;
        $uEmail = $user->email;
        $userDelete = false;

        if (count(Model_UserPension::getPensions($user->id)) == 1) {
            $user->delete();
            $userDelete = true;
        }

        Model_UserPension::delete($user->id, $pension->id);

        $template = View::factory('email-templates/co-worker-exclude-from-pension', array('uName' => $uName, 'penName' => $pension->name, 'ownerName' => $this->user->name, 'userDelete' => $userDelete));
        $email = new Email();
        $email = $email->send($uEmail, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Вас исключили из пансионата на сайте ' .$GLOBALS['SITE_NAME'] . '!', $template, true);

        if ($email == 1) {
            $response = new Model_Response_Pensions('PENSION_USER_DELETE_SUCCESS', 'success');
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
        $penID    = Arr::get($_POST,'penID');

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

        $org_uri = Request::$subdomain;
        $organization = Model_Organization::getByFieldName('uri', $org_uri);

        if (!$organization->id) {
            $response = new Model_Response_Organizations('ORGANIZATION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $this->checkAccessToManage($organization->id);

        $pension = new Model_Pension($penID);

        if (!$pension->id) {
            $response = new Model_Response_Pensions('PENSION_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ( !(in_array($role, self::PEN_AVAILABLE_ROLES) || $role = self::ROLE_PEN_CREATOR )) {
            $response = new Model_Response_Pensions('PENSION_USER_NOT_AVAILABLE_ROLE_ERROR', 'error');
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

        $password = substr(hash('md5', rand()),0,10);

        $user->password = $this->makeHash('md5', $password . getenv('SALT'));

        $user = $user->save();

        Model_UserPension::add($user->id, $pension->id);

        $hash = $this->makeHash('sha256', $user->id . $_SERVER['SALT'] . $user->email);
        $template = View::factory('email-templates/co-worker-invite-to-pension', array('user' => $user, 'pension' => $pension, 'owner' => $this->user, 'password' => $password, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Вас пригласили в пансионат на сайте ' .$GLOBALS['SITE_NAME'] . '!', $template, true);

        if ($email == 1) {
            $this->redis->set($_SERVER['REDIS_CONFIRMATION_HASHES'] . $hash, $user->id, array('nx', 'ex' => Date::MONTH));
            $response = new Model_Response_Pensions('PENSION_USER_INVITE_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }

        $this->response->body(@json_encode($response->get_response()));
    }


    private function checkAccessToManage($orgID)
    {
        if (!($this->user->role == self::ROLE_PEN_CREATOR||
            $this->user->role == self::ROLE_PEN_CO_WORKER_MANAGER||
            $this->user->organization == $orgID))
        {
            throw new HTTP_Exception_403();
        }
    }
}