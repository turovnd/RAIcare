<?php defined('SYSPATH') or die('No direct script access.');


Route::set('APPLICATIONS', 'applications')
    ->defaults(array(
        'controller'  => 'Applications_Index',
        'action'      => 'applications'
    ));

Route::set('APPLICATION', 'application/<id>')
    ->defaults(array(
        'controller'  => 'Applications_Index',
        'action'      => 'application'
    ));


Route::set('APPLICATION_AJAX', 'application/<action>')
    ->defaults(array(
        'controller'  => 'Applications_Ajax'
    ));
