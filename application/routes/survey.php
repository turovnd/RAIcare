<?php defined('SYSPATH') or die('No direct script access.');

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