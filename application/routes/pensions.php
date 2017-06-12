<?php defined('SYSPATH') or die('No direct script access.');


Route::set('PENSIONS', 'pensions/<action>', array(
        'action' => $STRING
    ))
    ->defaults(array(
        'controller'  => 'Pensions_Index',
    ));

Route::set('PENSION', 'pension/<id>', array(
        'id' => $DIGIT
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
