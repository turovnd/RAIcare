<?php defined('SYSPATH') or die('No direct script access.');

Route::set('SURVEYS', 'surveys')
    ->defaults(array(
        'controller'  => 'Surveys_Index',
        'action'      => 'all_surveys'
    ));


Route::set('SURVEY', 'survey/<s_pk>', array(
        's_pk'     => $DIGIT,
    ))
    ->defaults(array(
        'controller'  => 'Surveys_Index',
        'action'      => 'all_survey'
    ));


Route::set('PENSION_SURVEYS', 'pension/<pen_id>/survey/<s_id>',
    array(
        'pen_id' => $DIGIT,
        's_id'   => $DIGIT
    ))
    ->defaults(array(
        'controller' => 'Surveys_Index',
        'action'     => 'pen_survey'
    ));



Route::set('SURVEYS_AJAX', 'survey/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Surveys_Ajax',
    ));