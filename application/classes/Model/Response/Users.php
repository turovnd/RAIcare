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

}