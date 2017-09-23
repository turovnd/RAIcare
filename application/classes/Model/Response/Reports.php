<?php

class Model_Response_Reports extends Model_Response_Abstract
{
    protected $_REPORT_IS_NOT_AVAILABLE_ERROR = array (
        'type' => 'report',
        'code' => '170',
        'message' => 'Отчет не доступен'
    );

    protected $_REPORT_GET_SUCCESS = array (
        'type' => 'report',
        'code' => '171',
        'message' => 'Отчет успешно получен'
    );

}