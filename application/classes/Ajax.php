<?php

class Ajax extends Dispatch {

    const DEMO_ERROR = array(
        'status'  => 'error',
        'type'    => 'ajax',
        'code'    => '999',
        'message' => 'В демо режиме редактирование запрещено'
    );

    function before() {
        $this->auto_render = false;

        if (!self::is_ajax()) {
            throw new HTTP_Exception_403;
        }

        parent::before();

        if ($this->user->role == 2 && $this->request->action() != 'getunit') {
            throw new HTTP_Exception_403;
        }

        $this->checkCsrf();

    }

    public static function is_ajax()
    {
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;

        return false;
    }
}