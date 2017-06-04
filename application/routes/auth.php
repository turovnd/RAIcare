<?php defined('SYSPATH') or die('No direct script access.');


/**
 * Authentication Page
 */
Route::set('AUTH_PAGES', '<action>',
    array(
        'action' => 'login|logout|join'
    ))
    ->defaults(array(
        'controller'  => 'Auth_Index',
        'default'     => 'login',
    ));

//
///**
// * Join - new Application Page
// */
//Route::set('JOIN_PAGE', 'join')
//    ->defaults(array(
//        'controller'  => 'Auth_Index',
//        'action'     => 'join',
//    ));


/**
 * Authorization ajax action
 */
Route::set('AUTH_ACTIONS', 'auth/<action>')
    ->defaults(array(
        'controller'  => 'Auth_Ajax',
        'action'      => 'index',
    ));


Route::set('EMAIL_CONFIRMATION', 'auth/confirm/<hash>')
    ->defaults(array(
        'controller' => 'Auth_Ajax',
        'action'     => 'confirmEmail'
    ));

Route::set('RESET_PASSWORD_LINK', 'auth/reset/<hash>')
    ->defaults(array(
        'controller' => 'Auth_Ajax',
        'action'     => 'resetPassword'
    ));
