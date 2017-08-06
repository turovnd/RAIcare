<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Welcome page
 */
Route::set('WELCOME_PAGE', '')
    ->subdomains(array(Route::SUBDOMAIN_EMPTY, 'www'))
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();
