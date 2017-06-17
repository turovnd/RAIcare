<?php defined('SYSPATH') or die('No direct script access.');


Route::set('FORMS_AJAX', 'forms/<type>/<action>', array(
        'type' => 'longterm',
        'action'  => 'create|update'
    ))
    ->filter(function ($route, $params, $request) {
        $params['controller'] = 'Forms_Ajax';
        $params['action'] = $params['type'] . '_' . $params['action'];
        return $params;
    });