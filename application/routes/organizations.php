<?php defined('SYSPATH') or die('No direct script access.');

Route::set('ORGANIZATION', '(<action>(/<action2>))',
    array(
        'action'  => 'manage|control',
        'action2' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->filter(function ($route, $params, $request) {
        if ($params['action'] == 'control')
            $params['action'] = $params['action'] . '_' . $params['action2'];

        return $params;
    })
    ->defaults(array(
        'controller' => 'Organizations_Index',
        'action'     => 'index',
    ));

Route::set('ORGANIZATION_AJAX', 'organization/<action>', array(
        'action' => $STRING
    ))
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Organizations_Ajax'
    ));
