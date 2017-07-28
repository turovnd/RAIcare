<?php

class Model_Response_Email extends Model_Response_Abstract
{
    protected $_EMAIL_FORMAT_ERROR = array (
        'type' => 'email',
        'code' => '60',
        'message' => 'Не правильно указан формат электронной почты'
    );

    protected $_EMAIL_SEND_ERROR = array (
        'type' => 'email',
        'code' => '61',
        'message' => 'Произошла ошибка во время отправки письма, повторите попытку'
    );

    protected $_EMAIL_SEND_SUCCESS = array (
        'type' => 'email',
        'code' => '62',
        'message' => 'Письмо успешно отправлно'
    );

    protected $_RECAPTCHA_ERROR = array (
        'type' => 'recaptcha',
        'code' => '63',
        'message' => 'Вы не прошли проверку `Я не робот`'
    );
}