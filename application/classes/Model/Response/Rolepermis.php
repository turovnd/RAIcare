<?php

class Model_Response_Rolepermis extends Model_Response_Abstract
{
    protected $_ROLE_PERMISSION_EMPTY_ROLE_ERROR = array (
        'type' => 'rolepermission',
        'code' => '120',
        'message' => 'Не выбрана роль'
    );

    protected $_ROLE_PERMISSION_EMPTY_PERMISSION_ERROR  = array (
        'type' => 'rolepermission',
        'code' => '121',
        'message' => 'Не выбраны права доступа'
    );

    protected $_ROLE_PERMISSION_ROLE_EXISTED_ERROR = array (
        'type' => 'rolepermission',
        'code' => '122',
        'message' => 'Связь для выбранной роли уже существет'
    );

    protected $_ROLE_PERMISSION_CREATE_SUCCESS = array (
        'type' => 'rolepermission',
        'code' => '123',
        'message' => 'Связь роли и прав доступа успешно создана'
    );

    protected $_ROLE_PERMISSION_UPDATE_SUCCESS = array (
        'type' => 'rolepermission',
        'code' => '124',
        'message' => 'Связь роли и прав доступа успешно обновлена'
    );

    protected $_ROLE_PERMISSION_DELETE_SUCCESS = array (
        'type' => 'rolepermission',
        'code' => '125',
        'message' => 'Связь роли и прав доступа успешно удалена'
    );

}