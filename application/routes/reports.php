<?php defined('SYSPATH') or die('No direct script access.');


Route::set('REPORTS', 'survey/<pk>/<action>', array(
        'pk'   => $DIGIT,
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Reports_Index',
    ));

Route::set('REPORTS_PATIENT', 'pension/<pen_id>/survey/<sur_id>/<action>',
    array(
        'pen_id' => $DIGIT,
        'sur_id' => $DIGIT,
        'action'  => $STRING
    ))
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

