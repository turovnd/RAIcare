<?php defined('SYSPATH') or die('No direct script access.');


Route::set('USERS', 'users')
    ->defaults(array(
        'controller'  => 'Profiles_Index',
        'action'      => 'users'
    ));


Route::set('PROFILE', 'profile(/<id>)',array(
        'id' => $DIGIT
    ))
    ->defaults(array(
        'controller'  => 'Profiles_Index',
        'action'      => 'profile'
    ));

Route::set('PROFILE_AJAX', 'profile/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Profiles_Ajax'
    ));