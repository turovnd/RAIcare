<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Authentication Page
 */
Route::set('AUTH_PAGES', '<action>',
    array(
        'action' => 'login|logout|join'
    ))
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => ''
    ));

/**
 * Reset Password Page
 */
Route::set('RESET_PASSWORD_PAGE', 'reset/<hash>',
    array(
        'hash' => $STRING
    ))
    ->defaults(array(
        'controller' => 'Auth_Index',
        'action'     => 'reset',
    ));


/**
 * Authorization ajax action
 */
Route::set('AUTH_ACTIONS', 'auth/<action>')
    ->defaults(array(
        'controller'  => 'Auth_Ajax',
        'action'      => 'index',
    ));