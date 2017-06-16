<?php

class Model_Response_Permissions extends Model_Response_Abstract
{
    protected $_PERMISSION_EMPTY_NAME_ERROR = array (
        'type' => 'permission',
        'code' => '110',
        'message' => 'Укажите наименование права доступа'
    );

    protected $_PERMISSION_CREATE_SUCCESS = array (
        'type' => 'permission',
        'code' => '111',
        'message' => 'Право доступа успешно создано'
    );

    protected $_PERMISSION_EMPTY_ID_ERROR = array (
        'type' => 'permission',
        'code' => '112',
        'message' => 'Укажите id права доступа'
    );

    protected $_PERMISSION_UPDATE_SUCCESS = array (
        'type' => 'permission',
        'code' => '113',
        'message' => 'Право доступа успешно обновлено'
    );

    protected $_PERMISSION_DELETE_SUCCESS = array (
        'type' => 'permission',
        'code' => '114',
        'message' => 'Право доступа успешно удалено'
    );

    protected $_PERMISSION_EXISTED_ERROR = array (
        'type' => 'permission',
        'code' => '115',
        'message' => 'Право доступа с данным id уже существет'
    );

    protected $_PERMISSION_EMPTY_ERROR = array (
        'type' => 'permission',
        'code' => '116',
        'message' => 'Вы не выбрали права доступа'
    );

}