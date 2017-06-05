<?php defined('SYSPATH') or die('No direct script access.');


Route::set('ADMIN_PANEL', 'admin')
    ->defaults(array(
        'controller'  => 'Admin_Index',
        'action'      => 'admin'
    ));