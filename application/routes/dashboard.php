<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Main pages in app
 * - show all presentations
 */
Route::set('DASHBOARD', '<action>',  array(
        'action' => "dashboard"
    ))
    ->defaults(array(
        'controller'  => 'Dashboard_Index',
    ));

