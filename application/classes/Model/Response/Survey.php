<?php

class Model_Response_Survey extends Model_Response_Abstract
{

    protected $_SURVEY_TYPE_EMPTY_ERROR = array(
        'type' => 'survey',
        'code' => '160',
        'message' => 'Не выбрана причина прохождения оценки'
    );

    protected $_SURVEY_WITH_TYPE_1_ERROR = array(
        'type' => 'survey',
        'code' => '160',
        'message' => 'Первоначальная форма оценки уже проводиась'
    );

    protected $_SURVEY_CREATED_SUCCESS = array(
        'type' => 'survey',
        'code' => '161',
        'message' => 'Форма оценки успешно создана'
    );

    protected $_SURVEY_GET_SUCCESS = array(
        'type' => 'survey',
        'code' => '162',
        'message' => 'Форма оценки успешно получена'
    );

    protected $_SURVEY_DOES_NOT_EXISTED_ERROR = array(
        'type' => 'survey',
        'code' => '163',
        'message' => 'Форма оценки не существует'
    );

    protected $_SURVEY_HAS_BEEN_DELETED_ERROR = array(
        'type' => 'survey',
        'code' => '164',
        'message' => 'Форма оценки была удалена, так как прошло 3 дня с момента её создания. Создайте новую форму.'
    );

    protected $_SURVEY_UNIT_GET_SUCCESS = array(
        'type' => 'survey',
        'code' => '165',
        'message' => 'Раздел формы оценки успешно получен'
    );

    protected $_SURVEY_UNIT_UPDATE_SUCCESS = array(
        'type' => 'survey',
        'code' => '166',
        'message' => 'Информация сохранена'
    );

    protected $_SURVEY_UNIT_UPDATE_WARMING = array(
        'type' => 'survey',
        'code' => '167',
        'message' => 'Заполнены не все поля, не забудьте вернуться и заполнить их'
    );

    protected $_SURVEY_UNIT_POST_CODE_ERROR = array(
        'type' => 'survey',
        'code' => '168',
        'message' => 'Не правильно введен почтовый индекс постоянного места проживания'
    );
}