<?php

class Model_Response_Organizations extends Model_Response_Abstract
{
    protected $_ORGANIZATION_EMPTY_NAME_ERROR = array (
        'type' => 'organization',
        'code' => '130',
        'message' => 'Пожалйста, укажите название организации'
    );

    protected $_ORGANIZATION_EMPTY_URI_ERROR = array (
        'type' => 'organization',
        'code' => '131',
        'message' => 'Пожалйста, укажите адрес (URI) страницы'
    );

    protected $_ORGANIZATION_EXISTED_URI_ERROR = array (
        'type' => 'organization',
        'code' => '132',
        'message' => 'Организация с таким адресом уже существет'
    );


    protected $_ORGANIZATION_CREATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '133',
        'message' => 'Организация успешно создана'
    );

    protected $_CLIENT_ADD_SUCCESS = array (
        'type' => 'organization',
        'code' => '22',
        'message' => 'Клиент успешно добавлен'
    );

    protected $_CLIENT_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'organization',
        'code' => '23',
        'message' => 'Клиент не существет, перезагрузте страницу'
    );

    protected $_CLIENT_STATUS_ACCEPT_SUCCESS = array (
        'type' => 'organization',
        'code' => '24',
        'message' => 'Заявка успешно принята'
    );

    protected $_CLIENT_STATUS_REJECT_SUCCESS = array (
        'type' => 'organization',
        'code' => '25',
        'message' => 'Заявка успешно отклонена'
    );

    protected $_CLIENT_STATUS_REESTABLISH_SUCCESS = array (
        'type' => 'organization',
        'code' => '26',
        'message' => 'Заявка успешно восстановлена'
    );

    protected $_CLIENT_UPDATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '27',
        'message' => 'Информация успешно изменена'
    );

}