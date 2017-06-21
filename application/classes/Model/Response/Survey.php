<?php

class Model_Response_Survey extends Model_Response_Abstract
{

    protected $_SURVEY_TYPE_EMPTY_ERROR = array(
        'type' => 'Survey',
        'code' => '160',
        'message' => 'Не выбрана причина прохождения оценки'
    );

    protected $_SURVEY_CREATED_SUCCESS = array(
        'type' => 'Survey',
        'code' => '161',
        'message' => 'Форма оценки успешно создана'
    );

    protected $_SURVEY_GET_SUCCESS = array(
        'type' => 'Survey',
        'code' => '162',
        'message' => 'Форма успешно получена'
    );
}