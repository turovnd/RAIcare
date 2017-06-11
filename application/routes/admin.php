<?php defined('SYSPATH') or die('No direct script access.');


Route::set('ADMIN_PANEL', 'admin/<action>')
    ->defaults(array(
        'controller'  => 'Admin_Index',
    ));


Route::set('ADMIN_AJAX', 'admin/<section>/<action>',
    array(
        'section' => 'role|permission|rolepermis',
        'action'  => 'add|update|delete'
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller']   = 'Admin_Ajax';
        $params['action']       = $params['section'] . '_' . $params['action'];

        return $params;
    });