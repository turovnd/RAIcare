<?php defined('SYSPATH') or die('No direct script access.');


Route::set('ORGANIZATIONS', 'organizations/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Organizations_Index',
    ));

Route::set('ORGANIZATION', 'organization/<id>', array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller'  => 'Organizations_Index',
        'action'      => 'organization'
    ));


Route::set('ORGANIZATION_AJAX', 'organization/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Organizations_Ajax'
    ));
