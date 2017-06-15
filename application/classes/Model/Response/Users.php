<?php

class Model_Response_Users extends Model_Response_Abstract
{
    protected $_USER_CREATE_SUCCESS = array (
        'type' => 'user',
        'code' => '50',
        'message' => 'Пользователь успешно создан'
    );

    protected $_USER_EXISTED_ERROR = array (
        'type' => 'user',
        'code' => '51',
        'message' => 'Пользователь с такой эл.почтой существует'
    );

    protected $_USERNAME_EXISTED_ERROR = array (
        'type' => 'user',
        'code' => '52',
        'message' => 'Логин занят - придумайте другой'
    );

    protected $_USER_UPDATE_SUCCESS = array (
        'type' => 'user',
        'code' => '53',
        'message' => 'Информация успешно обновлена'
    );

    protected $_USER_UPDATE_WARNING = array (
        'type' => 'user',
        'code' => '54',
        'message' => 'Вы ничего не изменили'
    );

    protected $_USER_UPDATE_PASSWORD_EQUAL_ERROR = array (
        'type' => 'user',
        'code' => '55',
        'message' => 'Пароли не совпадают'
    );

    protected $_USER_UPDATE_PASSWORD_OLD_ERROR = array (
        'type' => 'user',
        'code' => '56',
        'message' => 'Указан не правильно пароль'
    );

    protected $_USER_UPDATE_PASSWORD_SUCCESS = array (
        'type' => 'user',
        'code' => '57',
        'message' => 'Пароль успешно изменен'
    );

    protected $_USER_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'user',
        'code' => '58',
        'message' => 'Пользователь не существует'
    );

}