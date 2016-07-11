<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 07/07/2016
 * Time: 16:04
 */
require( "../config.php" );


$socio = new Socio;
$socio->storeFormValues( $_POST );
$socio->insert();