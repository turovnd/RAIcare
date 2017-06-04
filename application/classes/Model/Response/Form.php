<?php

class Model_Response_Form extends Model_Response_Abstract
{

    protected $_EMPTY_FIELDS_ERROR = array(
        'type' => 'form',
        'code' => '30',
        'message' => 'Заполнены не все поля'
    );


}