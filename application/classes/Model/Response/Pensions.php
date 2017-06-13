<?php

class Model_Response_Pensions extends Model_Response_Abstract
{

    protected $_PENSION_EXISTED_URI_ERROR = array (
        'type' => 'pension',
        'code' => '140',
        'message' => 'Пансионат с таким адресом уже существет'
    );


    protected $_PENSION_CREATE_SUCCESS = array (
        'type' => 'pension',
        'code' => '141',
        'message' => 'Пансионат успешно создана'
    );


}