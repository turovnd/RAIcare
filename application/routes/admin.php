<?php defined('SYSPATH') or die('No direct script access.');

Route::set('ADMIN', '<action>', array(
        'action' => 'roles|users|organizations|pensions|clients'
    ))
    ->subdomains(array('admin'))
    ->defaults(array(
        'controller'  => 'Admin_Index',
    ));

Route::set('ADMIN_MODULES', '<action>/<id>', array(
        'action' => 'user|organization|pension',
        'id'     => $DIGIT,
    ))
    ->subdomains(array('admin'))
    ->defaults(array(
        'controller'  => 'Admin_Index',
    ));


Route::set('ADMIN_AJAX', 'admin/<mode>/<action>', array(
        'mode'   => 'role|user|organization|pension',
        'action' => $STRING
    ))
    ->filter(function ($route, $params, $request) {
        $params['action'] = $params['mode'] . '_' . $params['action'];
        return $params;
    })
    ->subdomains(array('admin'))
    ->defaults(array(
        'controller'  => 'Admin_Ajax'
    ));