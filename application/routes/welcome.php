<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Welcome page
 */
Route::set('WELCOME_PAGE', '')
    ->defaults(array(
        'controller' => 'Welcome',
        'action'     => 'index',
    ))
    ->cache();
