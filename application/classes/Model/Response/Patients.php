<?php

class Model_Response_Patients extends Model_Response_Abstract
{
    protected $_PATIENTS_GET_SUCCESS = array (
        'type' => 'patient',
        'code' => '150',
        'message' => 'Резиденты получены'
    );

    protected $_PATIENTS_CREATE_SUCCESS = array (
        'type' => 'patient',
        'code' => '151',
        'message' => 'Резидент успешно добавлен'
    );

    protected $_PATIENTS_DOES_NOT_EXISTED_ERROR = array (
        'type' => 'patient',
        'code' => '152',
        'message' => 'Резидент не существет'
    );

    protected $_PATIENTS_UPDATE_SUCCESS = array (
        'type' => 'patient',
        'code' => '153',
        'message' => 'Информация о резиденте успешно обновлена'
    );

    protected $_PATIENTS_UPDATE_WARNING = array (
        'type' => 'patient',
        'code' => '154',
        'message' => 'Вы ничего не изменили'
    );

    protected $_PATIENTS_NAME_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указан ФИО, оно должно быть записано в три слова'
    );

    protected $_PATIENTS_BIRTHDAY_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указана дата рождения'
    );

    protected $_PATIENTS_SNILS_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указан номер СНИЛСа'
    );

    protected $_PATIENTS_SNILS_EXISTED_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'В вашем пансионате уже заведен профиль резидентам с указанным номером СНИЛСа'
    );

    protected $_PATIENTS_EXSISTED_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указан номер СНИЛСа'
    );

    protected $_PATIENTS_OMS_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указан номер полиса ОМС или документа, его заменяющего'
    );

    protected $_PATIENTS_DISABILITY_CERTIFICATE_ERROR = array (
        'type' => 'patient',
        'code' => '155',
        'message' => 'Не правильно указан номер справки об инвалидности'
    );

    protected $_PATIENT_PENSION_ERROR = array (
        'type' => 'patient',
        'code' => '156',
        'message' => 'Резидент не принадлежит этому пансионату'
    );



}