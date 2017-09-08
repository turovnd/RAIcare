<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Welcome pages
 */
Route::set('WELCOME_PAGE', '(<action>)', array(
        'action' => 'software|training|join'
    ))
    ->subdomains(array(Route::SUBDOMAIN_EMPTY, 'www'))
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ));
