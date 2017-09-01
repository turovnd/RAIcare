<?php defined('SYSPATH') or die('No direct script access.');

$DIGIT  = '\d+';
$STRING = '\w+';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::$default_subdomains = array(Route::SUBDOMAIN_EMPTY, 'www');

Route::set('TeST', 'test')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test'
    ));

Route::set('TeST1', 'test1')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test1'
    ));

Route::set('TeST2', 'test2')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test2'
    ));

Route::set('TeST3', 'test3')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test3'
    ));

Route::set('TeST4', 'test4')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test4'
    ));
Route::set('TeST5', 'test5')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test5'
    ));
Route::set('TeST6', 'test6')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test6'
    ));
Route::set('TeST7', 'test7')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test7'
    ));
Route::set('TeST8', 'test8')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test8'
    ));
Route::set('TeST9', 'test9')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'test9'
    ));

Route::set('testcreate', 'testcreate')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'testcreate'
    ));

Route::set('testreports', 'reports')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Test',
        'action'     => 'reports'
    ));

require_once ('routes/welcome.php');
require_once ('routes/auth.php');
require_once ('routes/admin.php');
require_once ('routes/clients.php');
require_once ('routes/profiles.php');
require_once ('routes/dashboard.php');
require_once ('routes/organizations.php');
require_once ('routes/pensions.php');
require_once ('routes/patients.php');
require_once ('routes/survey.php');
require_once ('routes/staticFromDB.php');
require_once ('routes/reports.php');

/**
 * Route for file (image) uploading
 * Only for XMLHTTP requests
 */
Route::set('IMAGE_TRANSPORT', 'transport/<type>')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'upload'
    ));

?>
