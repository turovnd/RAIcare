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

    protected $_PENSION_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'pension',
        'code' => '142',
        'message' => 'Пансионат не существет'
    );

    protected $_PENSION_USER_DELETE_SUCCESS = array (
        'type' => 'pension',
        'code' => '143',
        'message' => 'Пользователь успешно исключен из пансионата'
    );

    protected $_PENSION_USER_INVITE_SUCCESS = array (
        'type' => 'pension',
        'code' => '144',
        'message' => 'Пользователь успешно приглашен в пансионат'
    );

    protected $_PENSION_UPDATE_SUCCESS = array (
        'type' => 'pension',
        'code' => '145',
        'message' => 'Информация успешно изменена'
    );

    protected $_PENSION_UPDATE_WARNING = array (
        'type' => 'pension',
        'code' => '146',
        'message' => 'Вы ничего не изменили'
    );

    protected $_PENSION_GET_SUCCESS = array (
        'type' => 'pension',
        'code' => '147',
        'message' => 'Пансионаты получены'
    );

    protected $_PENSION_USER_NOT_EMPTY_PENSIONS_ERROR = array (
        'type' => 'pension',
        'code' => '148',
        'message' => 'У пользователя с данной ролю должен быть хотя бы один пансионат'
    );

    protected $_PENSION_USER_NOT_AVAILABLE_ROLE_ERROR = array (
        'type' => 'pension',
        'code' => '149',
        'message' => 'Произошла ошибка, данная роль не доступна, обновите страницу'
    );


}