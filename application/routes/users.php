<?php defined('SYSPATH') or die('No direct script access.');


Route::set('USERS', 'users')
    ->defaults(array(
        'controller'  => 'Users_Index',
        'action'      => 'users'
    ));

Route::set('PROFILE', 'profile(/<id>)', array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller'  => 'Users_Index',
        'action'      => 'profile'
    ));


Route::set('PROFILE_AJAX', 'profile/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Users_Ajax'
    ));