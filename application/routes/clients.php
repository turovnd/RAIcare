<?php defined('SYSPATH') or die('No direct script access.');


Route::set('CLIENTS', 'clients')
    ->defaults(array(
        'controller'  => 'Clients_Index',
        'action'      => 'clients'
    ));

Route::set('CLIENT', 'client/<id>')
    ->defaults(array(
        'controller'  => 'Clients_Index',
        'action'      => 'client'
    ));


Route::set('CLIENT_AJAX', 'client/<action>')
    ->defaults(array(
        'controller'  => 'Clients_Ajax'
    ));
