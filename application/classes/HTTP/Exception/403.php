<?php

class HTTP_Exception_403 extends Kohana_HTTP_Exception_403 {

    const BAD_REQUEST_ERROR = array(
        'status'  => 'error',
        'type'    => 'ajax',
        'code'    => '999',
        'message' => 'Доступ запрещен'
    );


    function get_response()
    {
        $response = Response::factory();

        if (Ajax::is_ajax()) {

            $response->body( @json_encode(self::BAD_REQUEST_ERROR));

        } else{

            $view = View::factory('errors/403');
            $response->body($view->render());

        }

        return $response;
    }
}