<?php

class Model_Response_Patients extends Model_Response_Abstract
{
    protected $_PATIENTS_CREATE_SUCCESS = array (
        'type' => 'patient',
        'code' => '150',
        'message' => 'Пациент успешно добавлен'
    );

    protected $_PATIENTS_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'patient',
        'code' => '151',
        'message' => 'Пациент не существет'
    );

    protected $_PATIENTS_UPDATE_SUCCESS = array (
        'type' => 'patient',
        'code' => '152',
        'message' => 'Информация о пациенте успешно обновлена'
    );

    protected $_PATIENTS_UPDATE_WARNING = array (
        'type' => 'patient',
        'code' => '153',
        'message' => 'Вы ничего не изменили'
    );

    protected $_PATIENTS_GET_SUCCESS = array (
        'type' => 'patient',
        'code' => '154',
        'message' => 'Пациенты получены'
    );

}