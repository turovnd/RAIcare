<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Join Page
 */
Route::set('JOIN_PAGE', 'join')
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => 'join'
    ));

/**
 * Logout Route
 */
Route::set('LOGOUT', 'logout')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => 'logout'
    ));


/**
 * Reset Password Page
 */
Route::set('RESET_PASSWORD_PAGE', 'reset/<hash>',
    array(
        'hash' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => 'reset',
    ));

/**
 * Reset Password Page
 */
Route::set('CONFIRM_EMAIL', 'confirm/<hash>',
    array(
        'hash' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => 'confirm',
    ));


/**
 * Authorization ajax action
 */
Route::set('AUTH_ACTIONS', 'auth/<action>')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Auth_Ajax',
        'action'      => 'index',
    ));