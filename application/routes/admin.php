<?php defined('SYSPATH') or die('No direct script access.');

Route::set('ADMIN', '<action>', array(
        'action' => 'roles'
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Admin_Index',
    ));


Route::set('ADMIN_AJAX', 'admin/<action>', array(
        'action'  => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Admin_Ajax',
        'action'      => 'index'
    ));