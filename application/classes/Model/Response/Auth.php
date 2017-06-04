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

}