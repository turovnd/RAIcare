<?php

class Ajax extends Dispatch {

    const GET_ACTIONS= array('organization_get', 'pension_get');

    function before() {
        $this->auto_render = false;

        if (!self::is_ajax() && !in_array($this->request->action(), self::GET_ACTIONS)) {
            throw new HTTP_Exception_403;
        }

        parent::before();

        if ($this->user->role == 2 && $this->request->action() != 'getunit') {
            throw new HTTP_Exception_403;
        }

        if (!in_array($this->request->action(), self::GET_ACTIONS)) {
            $this->checkCsrf();
        }

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