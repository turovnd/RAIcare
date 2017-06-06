<?php

class Model_Response_Rolepermis extends Model_Response_Abstract
{
    protected $_ROLEPERMIS_EMPTY_ROLE_ERROR = array (
        'type' => 'rolepermis',
        'code' => '120',
        'message' => 'Не выбрана роль'
    );

    protected $_ROLEPERMIS_EMPTY_PERMISSION_ERROR  = array (
        'type' => 'rolepermis',
        'code' => '121',
        'message' => 'Не выбраны права доступа'
    );

    protected $_ROLEPERMIS_ROLE_EXISTED_ERROR = array (
        'type' => 'rolepermis',
        'code' => '122',
        'message' => 'Связь для выбранной роли уже существет'
    );

    protected $_ROLEPERMIS_CREATE_SUCCESS = array (
        'type' => 'rolepermis',
        'code' => '123',
        'message' => 'Связь роли и прав доступа успешно создана'
    );

    protected $_ROLEPERMIS_UPDATE_SUCCESS = array (
        'type' => 'rolepermis',
        'code' => '124',
        'message' => 'Связь роли и прав доступа успешно обновлена'
    );

    protected $_ROLEPERMIS_DELETE_SUCCESS = array (
        'type' => 'rolepermis',
        'code' => '125',
        'message' => 'Связь роли и прав доступа успешно удалена'
    );

}