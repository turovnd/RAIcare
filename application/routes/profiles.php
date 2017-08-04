<?php defined('SYSPATH') or die('No direct script access.');

Route::set('PROFILE', 'profile')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Profiles_Index',
        'action'      => 'profile'
    ));


//Route::set('USERS', 'users')
//    ->defaults(array(
//        'controller'  => 'Profiles_Index',
//        'action'      => 'users'
//    ));


Route::set('PROFILE_AJAX', 'profile/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Profiles_Ajax'
    ));