<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 07/07/2016
 * Time: 16:04
 */

echo $_POST["name"] . "Your email address is: " . $_POST["email"];

$socio = new Socio;
$socio->storeFormValues( $_POST );
$socio->insert();