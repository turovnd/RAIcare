<?php defined('SYSPATH') or die('No direct script access.');

Route::set('ORGANIZATION', '<org_uri>(/<action>)', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Organizations_Index',
        'action'      => 'index'
    ));

Route::set('ORGANIZATION_AJAX', 'organization/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Organizations_Ajax'
    ));
