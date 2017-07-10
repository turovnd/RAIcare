<?php defined('SYSPATH') or die('No direct script access.');


Route::set('GET_MKB_AJAX', 'mkb10/get')
    ->defaults(array(
        'controller'  => 'StaticFromDB',
        'action'      => 'MKB_get'
    ));