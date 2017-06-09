<?php defined('SYSPATH') or die('No direct script access.');


Route::set('CLIENTS', 'clients')
    ->defaults(array(
        'controller'  => 'Clients_Index',
        'action'      => 'clients'
    ));

Route::set('CLIENT', 'client/<id>', array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller'  => 'Clients_Index',
        'action'      => 'client'
    ));


Route::set('CLIENT_AJAX', 'client/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Clients_Ajax'
    ));


Route::set('NEW_CLIENT', 'application/new')
    ->defaults(array(
        'controller'  => 'Clients_Ajax',
        'action'      => 'new_application'
    ));