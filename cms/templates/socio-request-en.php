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

sendRequestEmail($socio);


function sendRequestEmail($socio) {
    $headers="From: <info@clubeuropeo.it>\n";
    $msg_body = "Hello " . $socio->firstname . " " . $socio->lastname . ",";
    $headers .= $msg_body;
    $oggetto="Enrolment Request - Club Europeo Ispra";
    $corpo="You receive this because you requested membership to Club Europeo Ispra. Club Eurpeo office will contact you soon in order to complete the renewal process. "
        . "In case you are receiving this email by mistake please reply on this address." . " Club Europeo Ispra.";

    mail($socio->email, $oggetto, $corpo, $headers);
}


