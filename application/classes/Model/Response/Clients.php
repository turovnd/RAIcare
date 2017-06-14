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

    protected $_CLIENT_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'client',
        'code' => '23',
        'message' => 'Клиент не существет, перезагрузте страницу'
    );

    protected $_CLIENT_STATUS_ACCEPT_SUCCESS = array (
        'type' => 'client',
        'code' => '24',
        'message' => 'Анкета клиента успешно принята'
    );

    protected $_CLIENT_STATUS_REJECT_SUCCESS = array (
        'type' => 'client',
        'code' => '24',
        'message' => 'Анкета клиента успешно отклонена'
    );

    protected $_CLIENT_STATUS_REESTABLISH_SUCCESS = array (
        'type' => 'client',
        'code' => '24',
        'message' => 'Анкета клиента успешно восстановлена'
    );

    protected $_CLIENT_STATUS_DELETE_SUCCESS = array (
        'type' => 'client',
        'code' => '24',
        'message' => 'Анкета клиента удалена'
    );

    protected $_CLIENT_UPDATE_SUCCESS = array (
        'type' => 'client',
        'code' => '25',
        'message' => 'Информация успешно изменена'
    );

    protected $_CLIENT_USER_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'client',
        'code' => '26',
        'message' => 'Для клиента ещё не создан пользователь, пожалуйста, создайте его'
    );

}