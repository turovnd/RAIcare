<?php defined('SYSPATH') or die('No direct script access.');


Route::set('USERS', 'users')
    ->defaults(array(
        'controller'  => 'Users_Index',
        'action'      => 'users'
    ));

Route::set('USER', 'user/<id>', array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller'  => 'Users_Index',
        'action'      => 'user'
    ));


Route::set('USER_AJAX', 'user/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Users_Ajax'
    ));