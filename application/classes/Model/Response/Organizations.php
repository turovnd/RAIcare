<?php

class Model_Response_Organizations extends Model_Response_Abstract
{
    protected $_ORGANIZATION_EXISTED_URI_ERROR = array (
        'type' => 'organization',
        'code' => '130',
        'message' => 'Организация с таким адресом уже существет'
    );

    protected $_ORGANIZATION_CREATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '131',
        'message' => 'Организация успешно создана'
    );

    protected $_ORGANIZATION_EXISTED_ERROR = array (
        'type' => 'organization',
        'code' => '132',
        'message' => 'Организация не существет'
    );

    protected $_ORGANIZATION_USER_DELETE_SUCCESS = array (
        'type' => 'organization',
        'code' => '133',
        'message' => 'Пользователь успешно исключен из организации'
    );

    protected $_ORGANIZATION_UPDATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '134',
        'message' => 'Информация успешно изменена'
    );

    protected $_ORGANIZATION_GET_SUCCESS = array (
        'type' => 'organization',
        'code' => '135',
        'message' => 'Организации получены'
    );

    protected $_ORGANIZATION_UPDATE_WARNING = array (
        'type' => 'organization',
        'code' => '135',
        'message' => 'Вы ничего не изменили'
    );


}