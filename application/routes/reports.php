<?php defined('SYSPATH') or die('No direct script access.');

Route::set('REPORTS_PATIENT', '<pen_uri>/report/<id>/<action>', array(
        'pen_uri' => $STRING,
        'id'      => $DIGIT,
        'action'  => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Reports_Index',
    ));

Route::set('REPORTS_AJAX', 'report/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Reports_Ajax',
    ));