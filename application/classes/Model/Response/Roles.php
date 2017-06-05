<?php

class Model_Response_Roles extends Model_Response_Abstract
{
    protected $_ROLE_EMPTY_NAME_ERROR = array (
        'type' => 'role',
        'code' => '100',
        'message' => 'Укажите наименование роли'
    );

    protected $_ROLE_CREATE_SUCCESS = array (
        'type' => 'role',
        'code' => '101',
        'message' => 'Роль успешно создана'
    );

    protected $_ROLE_EMPTY_ID_ERROR = array (
        'type' => 'role',
        'code' => '102',
        'message' => 'При передаче был потерян id, пожалйста, обновите страниц'
    );

    protected $_ROLE_UPDATE_SUCCESS = array (
        'type' => 'role',
        'code' => '103',
        'message' => 'Роль успешно обновлена'
    );

    protected $_ROLE_DELETE_SUCCESS = array (
        'type' => 'role',
        'code' => '104',
        'message' => 'Роль успешно удалена'
    );

}