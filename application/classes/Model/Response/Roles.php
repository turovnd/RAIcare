<?php

class Model_Response_Roles extends Model_Response_Abstract
{
    protected $_ROLE_CREATE_SUCCESS = array (
        'type' => 'role',
        'code' => '100',
        'message' => 'Роль успешно создана'
    );

    protected $_ROLE_UPDATE_SUCCESS = array (
        'type' => 'role',
        'code' => '101',
        'message' => 'Роль успешно обновлена'
    );

    protected $_ROLE_DELETE_SUCCESS = array (
        'type' => 'role',
        'code' => '102',
        'message' => 'Роль успешно удалена'
    );

    protected $_ROLE_EXISTED_ERROR = array (
        'type' => 'role',
        'code' => '103',
        'message' => 'Роль с таким id уже существует'
    );

    protected $_ROLE_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'role',
        'code' => '103',
        'message' => 'Роль с таким id не существует'
    );

}