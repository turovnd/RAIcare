<?php defined('SYSPATH') or die('No direct script access.');

Route::set('DASHBOARD', '<org_uri>/dashboard')
    ->defaults(array(
        'controller'  => 'Dashboard_Index',
        'action'      => 'dashboard'
    ));

