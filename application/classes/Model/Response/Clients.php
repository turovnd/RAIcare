<?php

class Model_Response_Clients extends Model_Response_Abstract
{
    protected $_CLIENTS_EMPTY_NAME_ERROR = array (
        'type' => 'client',
        'code' => '20',
        'message' => 'Пожалйста, укажите имя'
    );

    protected $_CLIENTS_APPLICATION_SEND_SUCCESS = array (
        'type' => 'client',
        'code' => '21',
        'message' => 'Заявка успешно отправлена'
    );

    protected $_CLIENTS_CREATE_SUCCESS = array (
        'type' => 'client',
        'code' => '21',
        'message' => 'Клиент успешно создан'
    );

}