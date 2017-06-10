<?php defined('SYSPATH') or die('No direct script access.');

$DIGIT  = '\d+';
$STRING = '\w+';


require_once ('routes/welcome.php');
require_once ('routes/auth.php');
require_once ('routes/admin.php');
require_once ('routes/clients.php');
require_once ('routes/profile.php');
require_once ('routes/dashboard.php');
require_once ('routes/organization.php');




/**
 * Route for file (image) uploading
 * Only for XMLHTTP requests
 */
Route::set('IMAGE_TRANSPORT', 'transport/<type>')
    ->defaults(array(
        'controller' => 'Transport',
        'action'     => 'upload'
    ));

?>
