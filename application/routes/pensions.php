<?php defined('SYSPATH') or die('No direct script access.');

Route::set('PENSION','<pen_uri>(/<action>)', array(
        'action' => 'settings|manage|control'
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Pensions_Index',
        'action'      => 'index'
    ));

Route::set('PENSION_AJAX', 'pension/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Pensions_Ajax'
    ));