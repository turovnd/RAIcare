<?php

class Model_Response_Longtermform extends Model_Response_Abstract
{

    protected $_FORM_TYPE_EMPTY_ERROR = array(
        'type' => 'longtermform',
        'code' => '160',
        'message' => 'Не выбрана причина прохождения оценки'
    );

    protected $_FORM_CREATED_SUCCESS = array(
        'type' => 'longtermform',
        'code' => '161',
        'message' => 'Форма оценки успещно создана'
    );

}