<?php defined('SYSPATH') or die('No direct script access.');


Route::set('PROFILE', 'profile', array(
        'action' => 'index'
    ))
    ->defaults(array(
        'controller'  => 'Profile_Index'
    ));


Route::set('PROFILE_AJAX', 'profile/<action>')
    ->defaults(array(
        'controller'  => 'Profile_Ajax'
    ));
