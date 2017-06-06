<?php

class Model_Response_Clients extends Model_Response_Abstract
{
    protected $_CLIENTS_EMPTY_NAME_ERROR = array (
        'type' => 'client',
        'code' => '20',
        'message' => 'Пожалйста, укажите Ваше имя'
    );

    protected $_CLIENTS_CREATE_SUCCESS = array (
        'type' => 'client',
        'code' => '21',
        'message' => 'Заявка успешно отправлена'
    );

    protected $_PERMISSION_CREATE_SUCCESS = array (
        'type' => 'client',
        'code' => '111',
        'message' => 'Право доступа успешно создано'
    );

    protected $_PERMISSION_EMPTY_ID_ERROR = array (
        'type' => 'client',
        'code' => '112',
        'message' => 'Укажите id права доступа'
    );

    protected $_PERMISSION_UPDATE_SUCCESS = array (
        'type' => 'client',
        'code' => '113',
        'message' => 'Право доступа успешно обновлено'
    );

    protected $_PERMISSION_DELETE_SUCCESS = array (
        'type' => 'client',
        'code' => '114',
        'message' => 'Право доступа успешно удалено'
    );

    protected $_PERMISSION_EXISTED_ERROR = array (
        'type' => 'client',
        'code' => '115',
        'message' => 'Право доступа с данным id уже существет'
    );

}