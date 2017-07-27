<?php

class Model_Response_Auth extends Model_Response_Abstract
{

    protected $_ATTEMPT_NUMBER_ERROR = array(
        'type' => 'login',
        'code' => '10',
        'message' => 'Number of attempts is more than allowed'
    );

    protected $_INVALID_INPUT_ERROR = array(
        'type' => 'login',
        'code' => '11',
        'message' => 'Не верное имя пользователя или пароль'
    );

    protected $_INVALID_PASSWORD_ERROR = array(
        'type' => 'login',
        'code' => '11',
        'message' => 'Не правильно введен пароль'
    );

    protected $_LOGIN_SUCCESS = array(
        'type' => 'login',
        'code' => '12',
        'message' => 'Успешная авторизация'
    );

    protected $_USER_DOES_NOT_EXIST_ERROR = array (
        'type' => 'login',
        'code' => '13',
        'message' => 'Пользователь не существует'
    );

    protected $_PASSWORDS_ARE_NOT_EQUAL_ERROR = array (
        'type' => 'login',
        'code' => '14',
        'message' => 'Пароли должны быть одинаковыми'
    );

    protected $_PASSWORD_CHANGE_SUCCESS = array (
        'type' => 'login',
        'code' => '15',
        'message' => 'Пароль успешно изменен'
    );

    protected $_RECOVER_ERROR = array(
        'type' => 'recover',
        'code' => '16',
        'message' => 'Сессия была уничтожена, перезагрузите страницу'
    );
    protected $_RECOVER_SUCCESS = array(
        'type' => 'recover',
        'code' => '17',
        'message' => 'Сессия успешно восстановлена'
    );

    protected $_RECOVER_CANCEL_SUCCESS = array(
        'type' => 'recover',
        'code' => '18',
        'message' => 'Полный выход из аккаунта с этого устройства выполнен'
    );

}