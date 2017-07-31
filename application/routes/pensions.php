<?php defined('SYSPATH') or die('No direct script access.');

Route::set('PENSION','<org_uri>/<pen_uri>(/<action>)', array(
        'action' => 'pension|settings|statistic'
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Index',
        'action'      => 'index'
    ));

Route::set('PENSION_AJAX', 'pension/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Ajax'
    ));