<?php defined('SYSPATH') or die('No direct script access.');

Route::set('PENSION_PATIENTS', '<pen_uri>/patients', array(
        'pen_uri' => $STRING,
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Patients_Index',
        'action'     => 'patients'
    ));


Route::set('PENSION_PATIENT', '<pen_uri>/patient/<id>(/<action>)', array(
        'pen_uri' => $STRING,
        'id'      => $DIGIT,
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Patients_Index',
        'action'     => 'patient'
    ));


Route::set('PATIENTS_AJAX', 'patient/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Patients_Ajax',
    ));