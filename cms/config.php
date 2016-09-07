<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 17/06/2016
 * Time: 11:02
 */
ini_set( "display_errors", true );
date_default_timezone_set( "Europe/Rome" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=clubeudb" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "mypass" );
require( CLASS_PATH . "/Socio.php" );
require( CLASS_PATH . "/Attivita.php" );
require( CLASS_PATH . "/Corso.php" );
function handleException( $exception ) {
    echo "Sorry, a problem occurred. Please try later.";
    error_log( $exception->getMessage() );
}
set_exception_handler( 'handleException' );