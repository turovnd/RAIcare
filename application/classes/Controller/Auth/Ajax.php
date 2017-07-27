<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Controller_Auth_Ajax
 *
 * @copyright RAIcare
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


        if ( empty($username) || empty($password)) {
            $this->makeAttempt();
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = new Model_Auth();
        $password = $this->makeHash('md5', $password . getenv('SALT'));

        if (!$user->login($username, $password)) {
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
     * action - SignIn Recover Session from cookie
     */
    public function action_signinrecover()
    {
        $password = Arr::get($_POST, 'password');

        if ( empty($password) ) {
            $response = new Model_Response_Form('EMPTY_FIELD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $id = $this->recover();

        // Если сессия была уничтожена или хэш не совпал
        if (!$id) {
            $this->clearCookie();

            $response = new Model_Response_Auth('RECOVER_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $password = $this->makeHash('md5', $password . getenv('SALT'));

        if ( !Model_Auth::checkPasswordById($id, $password) ) {
            $response = new Model_Response_Auth('INVALID_PASSWORD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Cookie::delete('attempt');

        $response = new Model_Response_Auth('RECOVER_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    /**
     * action - SignIn Recover Cancel - Clear Redis and Cookie
     */
    public function action_signinrecovercancel()
    {
        echo Debug::vars(1);
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');

        $hash   = $this->makeHash('sha256', getenv('SALT') . $sid . getenv('AUTHSALT') . $uid);

        $this->redis->delete(getenv('REDIS_SESSIONS_HASHES'). $hash);

        $this->clearCookie();

        $response = new Model_Response_Auth('RECOVER_CANCEL_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }


    /**
     * Check session token (make secret from Cookie data)
     *
     * @return null|string
     */
    private function recover()
    {
        /** get data from cookie  */
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');
        $secret = Cookie::get('secret');
        $hash   = $this->makeHash('sha256', getenv('SALT') . $sid . getenv('AUTHSALT') . $uid);

        if ($this->redis->get(getenv('REDIS_SESSIONS_HASHES') . $hash) && $hash == $secret) {

            $this->redis->delete(getenv('REDIS_SESSIONS_HASHES'). $hash);

            // Создаем новую сессию
            $auth = new Model_Auth();
            $auth->recoverById($uid);

            $session = Session::instance();
            $sid = $session->id();
            $uid = $session->get('uid');

            $this->setSecret($sid, $uid);

            return $uid;

        }

        return NULL;
    }

    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('uid');
        Cookie::delete('secret');
    }


    /**
     * action - Checking Email Confirmation hash
     * @throws HTTP_Exception_400
     */
    public function action_confirmEmail()
    {
        $hash = $this->request->param('hash');

        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

        if (!$id) {
            throw new HTTP_Exception_400;
        }

        $user = new Model_User($id);

        $user->is_confirmed = 1;

        $user->update();

        $this->redis->delete(getenv('REDIS_CONFIRMATION_HASHES') . $hash);

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

        $hash = $this->makeHash('sha256', getenv('SALT') . $user->id . Date::formatted_time('now'));

        $this->redis->set(getenv('REDIS_RESET_HASHES') . $hash, $user->id, array('nx', 'ex' => 3600));

        $template = View::factory('email_templates/reset_password', array('user' => $user, 'hash' => $hash));

        $email = new Email();

        return $email->send($user->email, getenv('INFO_EMAIL'), 'Сброс пароля на ' . getenv('SITE_NAME'), $template, true);

    }


    /**
     * action - Reset password Form
     */
    public function action_reset()
    {
        $this->checkRequest();

        $hash = Cookie::get('reset_link');
        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

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

        $password = $this->makeHash('md5', $newpass1 . getenv('SALT'));
        $user->changePassword($password);

        Cookie::delete('reset_link');
        $this->redis->delete(getenv('REDIS_RESET_HASHES') . $hash);
        
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

        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

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
        // генерируем новый хэш c новый session id
        $hash = $this->makeHash('sha256', getenv('SALT') . $sid . getenv('AUTHSALT') . $uid);

        // меняем хэш в куки
        Cookie::set('secret', $hash, Date::WEEK);

        // сохраняем в редис
        $this->redis->set(getenv('REDIS_SESSIONS_HASHES') . $hash, $sid . ':' . $uid , array('nx', 'ex' => Date::WEEK));
    }

}