<?php defined('SYSPATH') or die('No direct script access.');

//Route::set('REPORTS', 'survey/<pk>/<action>', array(
//        'pk'   => $DIGIT,
//        'action' => $STRING
//    ))
//    ->defaults(array(
//        'controller'  => 'Reports_Index',
//    ));

Route::set('REPORTS_PATIENT', '<pen_uri>/survey/<id>/<action>', array(
        'pen_uri' => $STRING,
        'id'      => $DIGIT,
        'action'  => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Reports_Index';
        $params['action'] = 'pen_' . $params['action'];

        return $params;
    })
    ->defaults(array(
        'action'  => ''
    ));

Route::set('REPORTS_AJAX', 'report/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Reports_Ajax',
    ));

