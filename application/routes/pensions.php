<?php defined('SYSPATH') or die('No direct script access.');


Route::set('PENSIONS', 'pensions/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Index',
    ));

Route::set('PENSION', 'pension/<id>(/<action>)', array(
        'id' => $DIGIT,
        'action' => 'pension|settings|statistic|survey|patients'
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Index',
        'action'      => 'pension'
    ));


Route::set('PENSIONS_AJAX', 'pension/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Ajax'
    ));


Route::set('PENSION_PATIENT', 'pension/<pension_id>/patient/<patient_id>(/<action>)',
    array(
        'pension_id' => $DIGIT,
        'patient_id' => $DIGIT,
        'action'  => ''
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Pensions_Index';

        if ($params['action'] != "")
            $params['action'] = 'patient_' . $params['action'];

        else
            $params['action'] = 'patient';

        return $params;
    });