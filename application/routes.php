<?php defined('SYSPATH') or die('No direct script access.');

$DIGIT  = '\d+';
$STRING = '\w+';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::$default_subdomains = array(Route::SUBDOMAIN_EMPTY, 'www');

require_once ('routes/welcome.php');
require_once ('routes/auth.php');
require_once ('routes/admin.php');
require_once ('routes/profiles.php');
require_once ('routes/dashboard.php');
require_once ('routes/organizations.php');
require_once ('routes/pensions.php');
require_once ('routes/patients.php');
require_once ('routes/survey.php');
require_once ('routes/staticFromDB.php');
require_once ('routes/reports.php');


Route::set('NEW_CLIENT', 'application/new')
    ->subdomains(array(Route::SUBDOMAIN_WILDCARD))
    ->defaults(array(
        'controller'  => 'Clients_Ajax',
        'action'      => 'new_application'
    ));

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
