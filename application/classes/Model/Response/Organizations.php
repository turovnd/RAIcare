<?php

class Model_Response_Organizations extends Model_Response_Abstract
{
    protected $_ORGANIZATION_EXISTED_URI_ERROR = array (
        'type' => 'organization',
        'code' => '130',
        'message' => 'Организация с таким адресом уже существет'
    );


    protected $_ORGANIZATION_CREATE_SUCCESS = array (
        'type' => 'organization',
        'code' => '131',
        'message' => 'Организация успешно создана'
    );


}