<?php

class Model_Response_Clients extends Model_Response_Abstract
{
    protected $_CLIENTS_EMPTY_NAME_ERROR = array (
        'type' => 'client',
        'code' => '20',
        'message' => 'Пожалйста, укажите имя'
    );

    protected $_CLIENTS_CREATE_SUCCESS = array (
        'type' => 'client',
        'code' => '21',
        'message' => 'Заявка успешно отправлена'
    );

    protected $_CLIENT_ADD_SUCCESS = array (
        'type' => 'client',
        'code' => '22',
        'message' => 'Клиент успешно добавлен'
    );

}