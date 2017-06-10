<?php

class Model_Response_Organizations extends Model_Response_Abstract
{
    protected $_ORGANIZATION_EMPTY_NAME_ERROR = array (
        'type' => 'organization',
        'code' => '130',
        'message' => 'Пожалйста, укажите название организации'
    );

    protected $_ORGANIZATION_EMPTY_URI_ERROR = array (
        'type' => 'organization',
        'code' => '131',
        'message' => 'Пожалйста, укажите адрес (URI) страницы'
    );

    protected $_ORGANIZATION_EXISTED_URI_ERROR = array (
        'type' => 'organization',
        'code' => '132',
        'message' => 'Организация с таким адресом уже существет'
    );


    protected $_ORGANIZATION_CREATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '133',
        'message' => 'Организация успешно создана'
    );


}