<?php defined('SYSPATH') or die('No direct script access.');

class Dispatch extends Controller_Template
{
    CONST POST = 'POST';
    CONST GET  = 'GET';
    CONST PRIVATE_SUBDOMIANS = array('admin', 'my', 'confirm', 'reset');

    CONST ROLE_ADMIN                    = 1;
    CONST ROLE_ORG_CREATOR              = 10;
    CONST ROLE_ORG_CO_WORKER_MANAGER    = 11;
    CONST ROLE_ORG_QUALITY_MANAGER      = 12;
    CONST ROLE_PEN_CREATOR              = 20;
    CONST ROLE_PEN_CO_WORKER_MANAGER    = 21;
    CONST ROLE_PEN_QUALITY_MANAGER      = 22;
    CONST ROLE_PEN_NURSE                = 23;

    CONST ORG_AVAILABLE_ROLES = array(11/*,12*/);
    CONST PEN_AVAILABLE_ROLES = array(21,22,23);


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

        /** Authentificated User is visible in all pages */
        View::set_global('user', $user);
        $this->user = $user;

        View::set_global('isLogged', self::isLogged());
        View::set_global('canLogin', self::canLogin());
        $address = Arr::get($_SERVER, 'HTTP_ORIGIN');

        View::set_global('assets', $address . DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR);

        $this->memcache = self::memcacheInstance();
        $this->redis    = self::redisInstance();
    }


    protected function makeHash($algo, $string) {
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
     * If user is not logged
     * @return bool
     */
    public static function isLogged()
    {
        $session = Session::Instance();
        return !empty($session->get('uid'));
    }

    /**
     * Return True if user had logged
     * @return bool
     */
    public static function hadLogged()
    {
        $secret   = Cookie::get('secret', '');
        $id       = Cookie::get('uid', '');
        $sid      = Cookie::get('sid', '');

        if ($secret && $id && $sid) {
            return true;
        }

        return false;
    }

    /**
     * Can user login or not
     * @return bool
     */
    public static function canLogin()
    {
        $isLogged  = self::isLogged();
        $hadLogged = self::hadLogged();

        $canLogin = false;

        if ($isLogged || (!$isLogged && $hadLogged))
            $canLogin = true;

        return $canLogin;
    }


    /**
     * Go To Login Page
     */
    public function gotoLoginPage()
    {
        header('Location: http://' . $_SERVER['HTTP_HOST']); die();
    }


}