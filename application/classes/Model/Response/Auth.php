<?php

class Model_Response_Auth extends Model_Response_Abstract
{
    protected $_LOGIN_INVALID_INPUT_ERROR = array(
        'type' => 'login',
        'code' => '10',
        'message' => 'Не верное имя пользователя или пароль'
    );

    protected $_LOGIN_SUCCESS = array(
        'type' => 'login',
        'code' => '11',
        'message' => 'Успешная авторизация'
    );

    protected $_LOGIN_RECOVER_ERROR = array(
        'type' => 'recover',
        'code' => '12',
        'message' => 'Сессия была уничтожена, перезагрузите страницу'
    );

    protected $_LOGIN_INVALID_PASSWORD_ERROR = array(
        'type' => 'recover',
        'code' => '12',
        'message' => 'Не правильно введен пароль'
    );

    protected $_LOGIN_RECOVER_SUCCESS = array(
        'type' => 'recover',
        'code' => '13',
        'message' => 'Сессия успешно восстановлена'
    );

    protected $_LOGIN_RECOVER_CANCEL_SUCCESS = array(
        'type' => 'recover',
        'code' => '14',
        'message' => 'Полный выход из аккаунта с этого устройства выполнен'
    );

    protected $_FORGET_RECAPTCHA_ERROR = array (
        'type' => 'recaptcha',
        'code' => '15',
        'message' => 'Вы не прошли проверку `Я не робот`'
    );








    protected $_USER_DOES_NOT_EXIST_ERROR = array (
        'type' => 'login',
        'code' => '13',
        'message' => 'Пользователь не существует'
    );

    protected $_PASSWORD_CHANGE_SUCCESS = array (
        'type' => 'login',
        'code' => '15',
        'message' => 'Пароль успешно изменен'
    );



}