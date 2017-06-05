<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Profile_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Profile_Ajax extends Ajax
{

    public function action_update()
    {
        $id = Arr::get($_POST, 'id');
        $uid = $this->session->get('uid');

        if ($id != $uid) {
            $response = new Model_Response_Profile('USER_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($id);

        $user->name = Arr::get($_POST, 'name');
        $user->newsletter = Arr::get($_POST, 'newsletter') ? 1 : 0;

        $user->update();

        $response = new Model_Response_Profile('USER_UPDATE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }



    /**
     * action_updatepassword - Update Profile Password
     */
    public function action_updatepassword()
    {
        $id = Arr::get($_POST, 'id');
        $uid = $this->session->get('uid');

        if ($id != $uid) {
            $response = new Model_Response_Profile('USER_ID_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $curPass = Arr::get($_POST, 'curPass');
        $newPass = Arr::get($_POST, 'newPass');
        $newPass1 = Arr::get($_POST, 'newPass1');

        if ( empty($curPass) || empty($newPass) || empty($newPass1) ) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($newPass != $newPass1) {
            $response = new Model_Response_Profile('PASSWORDS_ARE_NOT_EQUAL_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_User($id);

        $curPass = $this->makeHash('md5', $curPass . $_SERVER['SALT']);

        if (!$user->checkPassword($curPass)) {
            $response = new Model_Response_Profile('USER_INVALID_PASSWORD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $newPass = $this->makeHash('md5', $newPass . $_SERVER['SALT']);

        $user->changePassword($newPass);

        $response = new Model_Response_Profile('PASSWORD_CHANGE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }

}