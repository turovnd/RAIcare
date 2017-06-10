<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Auth_Ajax
 *
 * @copyright raisoft
 * @author Nikolai Turov
 * @version 0.0.0
 */

class Controller_Auth_Ajax extends Auth
{

    public function before()
    {
        $this->auto_render = false;
        if (!$this->request->is_ajax()) {
            throw new HTTP_Exception_403;
        }

        parent::before();

        $this->checkCsrf();

    }

    /**
     * action - SignIn
     */
    public function action_signin()
    {

//        if ($this->getAttempt() > 3) {
//            $response = new Model_Response_Auth('ATTEMPT_NUMBER_ERROR', 'error');
//            $this->response->body(@json_encode($response->get_response()));
//            return;
//        }

        $username   = Arr::get($_POST, 'username');
        $password   = Arr::get($_POST, 'password');
        $remember   = false;

        if ( empty($username) || empty($password)) {
            $this->makeAttempt();
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_Auth();
        $password = $this->makeHash('md5', $password . $_SERVER['SALT']);

        if (!$user->login($username, $password, $remember)) {
            $this->makeAttempt();
            $response = new Model_Response_Auth('INVALID_INPUT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Cookie::delete('attempt');

        $session = Session::instance();
        $sid = $session->id();
        $uid = $session->get('uid');

        $this->setSecret($sid, $uid);

        $response = new Model_Response_Auth('LOGIN_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * action - Checking Email Confirmation hash
     * @throws HTTP_Exception_400
     */
    public function action_confirmEmail()
    {
        $hash = $this->request->param('hash');

        $id = $this->redis->get($_SERVER['REDIS_PACKAGE'] . ':confirmation:email:' . $hash);

        if (!$id) {
            throw new HTTP_Exception_400;
        }

        $user = new Model_User($id);

        $user->is_confirmed = 1;

        $user->update();

        $this->redis->delete($_SERVER['REDIS_PACKAGE'] . ':confirmation:email:' . $hash);

        $this->redirect('app');

    }


    /**
     * action - Forget password Form
     */
    public function action_forget()
    {
        $this->checkRequest();

        $email = Arr::get($_POST, 'email', '');

        if ( empty($email) ) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = Model_User::getByFieldName('email', $email);

        if (!$user->id) {
            $response = new Model_Response_Auth('USER_DOES_NOT_EXIST_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $isSuccess = $this->send_forget_email($user);

        if ($isSuccess) {
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }
        $this->response->body(@json_encode($response->get_response()));
    }
    
    
    /**
     *  Send Email for Reset Password
     * @param $user
     * @return boolean
     */
    private function send_forget_email($user) {

        $hash = $this->makeHash('sha256', $_SERVER['SALT'] . $user->id . Date::formatted_time('now'));

        $this->redis->set($_SERVER['REDIS_PACKAGE'] . ':reset:password:' . $hash, $user->id, array('nx', 'ex' => 3600));

        $template = View::factory('email_templates/reset_password', array('user' => $user, 'hash' => $hash));

        $email = new Email();

        return $email->send($user->email, $_SERVER['INFO_EMAIL'], 'Сброс пароля на ' . $_SERVER['SITE_NAME'], $template, true);

    }


    /**
     * action - Reset password Form
     */
    public function action_reset()
    {
        $this->checkRequest();

        $hash = Cookie::get('reset_link');
        $id = $this->redis->get($_SERVER['REDIS_PACKAGE'] . ':reset:password:' . $hash);

        $user = new Model_User($id);

        if (!$user->id) {
            $response = new Model_Response_Auth('USER_DOES_NOT_EXIST_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $newpass1 = Arr::get($_POST, 'password', '');
        $newpass2 = Arr::get($_POST, 'password1', '');

        if ($newpass1 != $newpass2) {
            $response = new Model_Response_Auth('PASSWORDS_ARE_NOT_EQUAL_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $password = $this->makeHash('md5', $newpass1 . $_SERVER['SALT']);
        $user->changePassword($password);

        Cookie::delete('reset_link');
        $this->redis->delete($_SERVER['REDIS_PACKAGE'] . ':reset:password:' . $hash);
        
        $response = new Model_Response_Auth('PASSWORD_CHANGE_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));

    }


    /**
     * action - Checking Reset password hash
     * @throws HTTP_Exception_400
     */
    public function action_resetPassword() {

        Cookie::delete('reset_link');

        $hash = $this->request->param('hash');

        $id = $this->redis->get($_SERVER['REDIS_PACKAGE'] . ':reset:password:' . $hash);

        $user = new Model_User($id);

        if (!$user->id) {
            throw new HTTP_Exception_400();
        }

        Cookie::set('reset_link', $hash, Date::HOUR);

        $this->redirect('login');

    }
    

    /**
     * Set `secret` to cookie and Redis
     */
    protected function setSecret($sid, $uid)
    {
        $hash = $this->makeHash('sha256', $_SERVER['SALT'] . $sid . $_SERVER['AUTHSALT'] . $uid);

        Cookie::set('secret', $hash, Date::WEEK);

        $this->redis->set($_SERVER['REDIS_PACKAGE'] . ':sessions:secrets:' . $hash, $sid . ':' . $uid . ':' . Request::$client_ip, array('nx', 'ex' => Date::WEEK));
    }

}