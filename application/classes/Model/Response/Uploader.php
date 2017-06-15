<?php

class Model_Response_Uploader extends Model_Response_Abstract
{
    protected $_UPLOADER_NO_USER_ERROR = array (
        'type' => 'upload',
        'code' => '80',
        'message' => 'Доступ запещен'
    );

    protected $_UPLOADER_NO_TYPE_ERROR = array (
        'type' => 'upload',
        'code' => '81',
        'message' => 'Утерян формат файла'
    );

    protected $_UPLOADER_WRONG_TYPE_ERROR = array (
        'type' => 'upload',
        'code' => '82',
        'message' => 'Формат файла не поддерживается'
    );

    protected $_UPLOADER_FILE_SIZE_ERROR = array (
        'type' => 'upload',
        'code' => '83',
        'message' => 'Загружаемый файл слишком большой. Размер не должен быть более 2 Мб'
    );

    protected $_UPLOADER_FILE_NOT_TRANSFERRED_ERROR = array (
        'type' => 'upload',
        'code' => '84',
        'message' => 'Файл не был загружен'
    );

    protected $_UPLOADER_FILE_EMPTY_ERROR = array (
        'type' => 'upload',
        'code' => '85',
        'message' => 'Загружаемый файл пустой'
    );

    protected $_UPLOADER_FILE_DAMAGED_ERROR = array (
        'type' => 'upload',
        'code' => '86',
        'message' => 'Загружаемый файл поврежден'
    );

    protected $_UPLOADER_FILE_ERROR = array (
        'type' => 'upload',
        'code' => '87',
        'message' => 'Произошла ошибка во время загрзки'
    );

    protected $_UPLOADER_FILE_SUCCESS = array (
        'type' => 'upload',
        'code' => '88',
        'message' => 'Файл успешно загружен'
    );



}