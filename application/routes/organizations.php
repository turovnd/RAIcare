<?php defined('SYSPATH') or die('No direct script access.');


Route::set('ORGANIZATIONS', 'organizations')
    ->defaults(array(
        'controller'  => 'Organizations_Index',
        'action'      => 'organizations'
    ));


Route::set('CREATED_ORGANIZATIONS', 'organizations/created')
    ->defaults(array(
        'controller'  => 'Organizations_Index',
        'action'      => 'created_organizations'
    ));

Route::set('MY_ORGANIZATIONS', 'organizations/my')
    ->defaults(array(
        'controller'  => 'Organizations_Index',
        'action'      => 'my_organizations'
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
