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
        'action'      => 'profile'
    ));

Route::set('USER_AJAX', 'user/<action>', array(
    'action' => 'add|new'
))
    ->defaults(array(
        'controller'  => 'Users_Ajax'
    ));

Route::set('PROFILE', 'profile')
    ->defaults(array(
        'controller'  => 'Users_Index',
        'action'      => 'profile'
    ));

Route::set('PROFILE_AJAX', 'profile/<action>', array(
        'action' => 'update'
    ))
    ->defaults(array(
        'controller'  => 'Users_Ajax'
    ));