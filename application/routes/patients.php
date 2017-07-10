<?php defined('SYSPATH') or die('No direct script access.');

Route::set('PATIENTS', 'patients')
    ->defaults(array(
        'controller'  => 'Patients_Index',
        'action'      => 'all_patients'
    ));


Route::set('PATIENT', 'patient/<pat_pk>(/<action>)', array(
        'pat_pk'     => $DIGIT,
        'action' => ''
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Patients_Index';

        if ($params['action'] != "")
            $params['action'] = 'all_patient_' . $params['action'];

        else
            $params['action'] = 'all_patient';

        return $params;
    })
    ->defaults(array(
        'action'  => ''
    ));


Route::set('PENSION_PATIENTS', 'pension/<pen_id>/patients',
    array(
        'pen_id' => $DIGIT,
    ))
    ->defaults(array(
        'controller' => 'Patients_Index',
        'action'     => 'pen_patients'
    ));


Route::set('PENSION_PATIENT', 'pension/<pen_id>/patient/<pat_id>(/<action>)',
    array(
        'pen_id' => $DIGIT,
        'pat_id' => $DIGIT,
        'action'  => ''
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Patients_Index';

        if ($params['action'] != "")
            $params['action'] = 'pen_patient_' . $params['action'];

        else
            $params['action'] = 'pen_patient';

        return $params;
    })
    ->defaults(array(
        'action'  => ''
    ));


Route::set('PATIENTS_AJAX', 'patient/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Patients_Ajax',
    ));