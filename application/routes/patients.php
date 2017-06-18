<?php defined('SYSPATH') or die('No direct script access.');


Route::set('PATIENTS', 'patients')
    ->defaults(array(
        'controller'  => 'Patients_Index',
        'action'      => 'all_patients'
    ));


Route::set('PATIENT', 'patient/<id>(/<action>)', array(
        'id' => $DIGIT,
        'action'  => ''
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Patients_Index';

        if ($params['action'] != "")
            $params['action'] = 'patient_' . $params['action'];

        else
            $params['action'] = 'patient';

        return $params;
    })
    ->defaults(array(
        'action'  => ''
    ));



Route::set('PATIENTS_AJAX', 'patient/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Patients_Ajax'
    ));


