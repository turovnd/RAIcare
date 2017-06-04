<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Main pages in app
 * - show all presentations
 */
Route::set('APP', 'app')
    ->defaults(array(
        'controller'  => 'App_Index',
        'action'     => 'dashboard',
    ));

