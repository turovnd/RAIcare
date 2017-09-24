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
//            $response = new Model_Response_Auth('', 'error');
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

        $auth = new Model_Auth();
        $password = $this->makeHash('md5', $password . getenv('SALT'));

        if (!$auth->login($username, $password)) {
            $this->makeAttempt();
            $response = new Model_Response_Auth('LOGIN_INVALID_INPUT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Cookie::delete('attempt');

        $session = Session::instance();
        $sid = $session->id();
        $uid = $session->get('uid');

        if (!$this->has_access($session->get('oid'))) {
            $response = new Model_Response_Organizations('ORGANIZATION_ACCESS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

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

        if ($id === "HAS_NO_ACCESS") {
            $response = new Model_Response_Organizations('ORGANIZATION_ACCESS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        // Если сессия была уничтожена или хэш не совпал
        if ($id === NULL) {
            $this->clearCookie();

            $response = new Model_Response_Auth('LOGIN_RECOVER_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $password = $this->makeHash('md5', $password . getenv('SALT'));

        if ( !Model_Auth::checkPasswordById($id, $password) ) {
            $response = new Model_Response_Auth('LOGIN_INVALID_PASSWORD_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        Cookie::delete('attempt');

        $response = new Model_Response_Auth('LOGIN_RECOVER_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * action - SignIn Recover Cancel - Clear Redis and Cookie
     */
    public function action_signinrecovercancel()
    {
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');

        $auth = new Model_Auth();
        $auth->logout();

        $hash   = $this->makeHash('sha256', getenv('SALT') . $sid . getenv('AUTHSALT') . $uid);
        $this->redis->delete(getenv('REDIS_SESSIONS_HASHES'). $hash);

        $this->clearCookie();

        $response = new Model_Response_Auth('LOGIN_RECOVER_CANCEL_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * action - Forget password Form
     */
    public function action_forget()
    {
        $email = Arr::get($_POST, 'email');
        $captcha = Arr::get($_POST, 'g-recaptcha-response');

        if ( !Valid::email($email) ) {
            $response = new Model_Response_Email('EMAIL_FORMAT_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $recaptcha = new \ReCaptcha\ReCaptcha(getenv('RECAPTCHA'));

        $resp = $recaptcha->verify($captcha, $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()){
            $response = new Model_Response_Email('RECAPTCHA_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user = Model_User::getByFieldName('email', $email);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $hash = $this->makeHash('sha256', $user->id . getenv('SALT') . $user->email);
        $template = View::factory('email-templates/reset-password', array('user' => $user, 'hash' => $hash));

        $email = new Email();
        $email = $email->send($user->email, array($_SERVER['INFO_EMAIL'], $_SERVER['INFO_EMAIL_NAME']), 'Восстановление пароля', $template, true);

        if ($email == 1) {
            $this->redis->set(getenv('REDIS_RESET_HASHES') . $hash, $user->id, array('nx', 'ex' => Date::HOUR));
            $response = new Model_Response_Email('EMAIL_SEND_SUCCESS', 'success');
        } else {
            $response = new Model_Response_Email('EMAIL_SEND_ERROR', 'error');
        }
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * action - Reset password Form
     */
    public function action_reset()
    {

        $hash     = Arr::get($_POST, 'hash');
        $newpass1 = Arr::get($_POST, 'password');
        $newpass2 = Arr::get($_POST, 'password1');

        if (empty($newpass1) || empty($newpass2)) {
            $response = new Model_Response_Form('EMPTY_FIELDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        if ($newpass1 != $newpass2) {
            $response = new Model_Response_Users('USER_UPDATE_PASSWORD_EQUAL_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $id = $this->redis->get(getenv('REDIS_RESET_HASHES') . $hash);

        $user = new Model_User($id);

        if (!$user->id) {
            $response = new Model_Response_Users('USER_DOES_NOT_EXISTED_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $password = $this->makeHash('md5', $newpass1 . getenv('SALT'));

        if ( $user->checkPassword($password) ) {
            $response = new Model_Response_Users('USER_SAME_PASSWORDS_ERROR', 'error');
            $this->response->body(@json_encode($response->get_response()));
            return;
        }

        $user->changePassword($password);

        $auth = new Model_Auth();
        $auth->login($user->email, $password);

        $this->redis->delete(getenv('REDIS_RESET_HASHES') . $hash);

        $response = new Model_Response_Users('USER_RESET_PASSWORD_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
        return;
    }

    /**
     * action - Reset password Form
     */
    public function action_resetcancel()
    {
        $hash     = Arr::get($_POST, 'hash');
        $this->redis->delete(getenv('REDIS_RESET_HASHES') . $hash);

        $response = new Model_Response_Users('USER_RESET_PASSWORD_CANCEL_SUCCESS', 'success');
        $this->response->body(@json_encode($response->get_response()));
    }

    /**
     * Check session token (make secret from Cookie data)
     *
     * @return null|string
     */
    private function recover()
    {
        $session = Session::instance();

        if (!$this->has_access($session->get('oid'))) {
            return "HAS_NO_ACCESS";
        }

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

    /**
     * Clear cookie
     */
    private function clearCookie()
    {
        Cookie::delete('sid');
        Cookie::delete('uid');
        Cookie::delete('secret');
    }

    /**
     * Set `secret` to cookie and Redis
     */
    private function setSecret($sid, $uid)
    {
        // генерируем новый хэш c новый session id
        $hash = $this->makeHash('sha256', getenv('SALT') . $sid . getenv('AUTHSALT') . $uid);

        // меняем хэш в куки
        Cookie::set('secret', $hash, Date::WEEK);

        // сохраняем в редис
        $this->redis->set(getenv('REDIS_SESSIONS_HASHES') . $hash, $sid . ':' . $uid , array('nx', 'ex' => Date::WEEK));
    }

    private function has_access($oid) {
        $subdomain = Request::$subdomain;

        if (in_array($subdomain, self::PRIVATE_SUBDOMIANS) && $oid == 0)
            return true;

        $organization = Model_Organization::getByUri($subdomain);

        if ($oid != $organization->id) {
            return false;
        }
        return true;
    }
}