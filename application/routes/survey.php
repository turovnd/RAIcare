<?php defined('SYSPATH') or die('No direct script access.');

//Route::set('SURVEYS', 'surveys')
//    ->defaults(array(
//        'controller'  => 'Surveys_Index',
//        'action'      => 'all_surveys'
//    ));
//
//
//Route::set('SURVEY', 'survey/<s_pk>', array(
//        's_pk'     => $DIGIT,
//    ))
//    ->defaults(array(
//        'controller'  => 'Surveys_Index',
//        'action'      => 'all_survey'
//    ));

Route::set('PENSION_SURVEYS', '<pen_uri>/surveys', array(
        'pen_uri' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Surveys_Index',
        'action'     => 'surveys'
    ));

Route::set('PENSION_SURVEY', '<pen_uri>/survey/<id>', array(
        'pen_uri' => $STRING,
        'id'   => $DIGIT
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Surveys_Index',
        'action'     => 'survey'
    ));

Route::set('SURVEYS_AJAX', 'survey/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Surveys_Ajax',
    ));