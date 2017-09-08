<?php defined('SYSPATH') or die('No direct script access.');

Route::set('DASHBOARD', 'dashboard')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Dashboard_Index',
        'action'      => 'dashboard'
    ));

