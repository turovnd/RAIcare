<?php defined('SYSPATH') or die('No direct script access.');

class Dispatch extends Controller_Template
{
    const POST                  = 'POST';
    const GET                   = 'GET';
    const SALT                  = "b82d12b5be9c4f0d37a8501859e89762";
    const AUTHSALT              = "e4dff5bbee5839ea587d38cc03917150";
    const REDIS_SESSIONS_HASHES = "raicare:sessions:";

    /** @var string - Path to template */
    public $template = '';

    /** @var $errors - Page erros */
    protected $errors;

    /** @var  $memcache - Memcache */
    protected $memcache;

    /** @var $redis - Redis instance */
    protected $redis;

    /** @var  $session - Session singleton instance */
    protected $session;

    /** @var  $user - Current user */
    public    $user;

    function before()
    {
        $GLOBALS['SITE_NAME']     = "RAIcare";
        $GLOBALS['FROM_ACTION']   = $this->request->action();

        // XSS clean in POST and GET requests
        self::XSSfilter();

        $driver = 'native';
        $this->session = self::sessionInstance($driver);

        parent::before();

        $this->setGlobals();

        if ($this->auto_render) {

            // Initialize with empty values
            $this->template->title       = '';
            $this->template->keywords    = strtolower($GLOBALS['SITE_NAME']) . '';
            $this->template->description = $GLOBALS['SITE_NAME'] . ' - универсальное система для измерения качества и эффективности функциональных возможностей и состояния здоровья.';
            $this->template->content     = $GLOBALS['SITE_NAME'];
        }

    }

    /**
    * The after() method is called after your controller action.
    * In our template controller we override this method so that we can
    * make any last minute modifications to the template before anything
    * is rendered.
    */
    public function after()
    {
        parent::after();
    }

    /**
    * Sanitizes GET and POST params
    * @uses HTMLPurifier
    */
    public function XSSfilter()
    {
        $exceptions = array( 'long_desc' , 'blog_text', 'long_description' , 'content' ); // Исключения для полей с визуальным редактором
        foreach ($_POST as $key => $value) {
            if (gettype($value) == 'array') {
                foreach ($value as $key1 => $value1) {
                    if (gettype($value1) == 'array') {
                        foreach ($value1 as $key2 => $value2) {
                            $this->doPostCheck($exceptions, $key2, $value2);
                        }
                    } else {
                        $this->doPostCheck($exceptions, $key1, $value1);
                    }
                }
            } else {
                $this->doPostCheck($exceptions, $key, $value);
            }
        }
        foreach ($_GET  as $key => $value) {
            if (gettype($value) == 'array') {
                foreach ($value as $key1 => $value1) {
                    $this->doGetCheck($key1, $value1);
                }
            } else {
                $this->doGetCheck($key, $value);
            }
        }
    }

    private function doPostCheck($exceptions, $key, $value){

        $value = stripos($value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value;
        if (in_array($key, $exceptions) === false) {
            $_POST[$key] = Security::xss_clean(HTML::chars($value));
        } else {
            $_POST[$key] = strip_tags(trim($value), '<br><em><del><p><a><b><strong><i><strike><blockquote><ul><li><ol><img><tr><table><td><th><span><h1><h2><h3><iframe>');
        }
    }

    private function doGetCheck($key, $value){
        $value = stripos( $value, 'سمَـَّوُوُحخ ̷̴̐خ ̷̴̐خ ̷̴̐خ امارتيخ ̷̴̐خ') !== false ? '' : $value;
        $_GET[$key] = Security::xss_clean(HTML::chars($value));
    }

    /**
     * Redis connection
     */
    public static function redisInstance()
    {
        $config = Kohana::$config->load('redis.default');

        $redis = new Redis();
        $redis->connect($config['hostname'], $config['port']);
        $redis->auth($config['password']);
        $redis->select(0);

        return $redis;
    }


    public static function memcacheInstance()
    {
        return Cache::instance('memcacheimp');
    }


    public static function sessionInstance($driver)
    {
        return Session::instance($driver);
    }

    private function setGlobals()
    {
        $uid = $this->session->get('uid') ?: (int) Cookie::get('uid');

        $user = new Model_User($uid);

        $role = new Model_Role($user->role);
        $user->permissions = json_decode($role->permissions);

        /** Authentificated User is visible in all pages */
        View::set_global('user', $user);
        $this->user = $user;


        $address = Arr::get($_SERVER, 'HTTP_ORIGIN');
        View::set_global('assets', $address . DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR);

        $this->memcache = self::memcacheInstance();
        $this->redis    = self::redisInstance();
    }


    protected static function makeHash($algo, $string) {
        return hash($algo, $string);
    }


    protected function checkCsrf()
    {
        /** Check CSRF */
        if (!isset($_POST['csrf']) || !empty($_POST['csrf']) && !Security::check(Arr::get($_POST, 'csrf', ''))) {
            throw new HTTP_Exception_403();
        }

        return true;
    }



    /**
     * Return "True" if user is logged
     *
     * Check session id
     * Check session token (make secret from Cookie data and check in redis)
     * @return bool
     */
    public static function isLogged()
    {
        $session = Session::Instance();

        if ( empty($session->get('uid')) ) {
            return false;
        }

        $redis = self::redisInstance();

        /** get data from cookie  */
        $uid    = Cookie::get('uid');
        $sid    = Cookie::get('sid');
        $secret = Cookie::get('secret');
        $hash   = self::makeHash('sha256', self::SALT . $sid . self::AUTHSALT . $uid);

        if ($redis->get(self::REDIS_SESSIONS_HASHES .$hash) && $hash == $secret) {

            // Создаем новую сессию
            $auth = new Model_Auth();
            $auth->recoverById($uid);

            $sid = $session->id();
            $uid = $session->get('uid');

            $redis->delete(self::REDIS_SESSIONS_HASHES .$hash);

            // генерируем новый хэш c новый session id
            $newHash = self::makeHash('sha256', self::SALT . $sid . self::AUTHSALT . $uid);

            // меняем хэш в куки
            Cookie::set('secret', $newHash, Date::WEEK);

            // сохраняем в редис
            $redis->set(self::REDIS_SESSIONS_HASHES .$hash, $sid . ':' . $uid , array('nx', 'ex' => Date::WEEK));

            return true;

        }

        return false;

    }


    /**
     * Checking user access for module
     * @param $permission - module ID
     * @throws HTTP_Exception_403
     */
    public function hasAccess($permission)
    {
        if (!in_array($permission, $this->user->permissions)) {
            throw new HTTP_Exception_403;
        }
    }


}