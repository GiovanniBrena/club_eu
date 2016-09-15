<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 14/09/16
 * Time: 22:43
 */
require( "../config.php" );



$socio = Socio::getByPersonalIdAndEmail($_POST['personal_id'], $_POST['email']);
if($socio) {
    $socio->state=2;
    $socio->personal_id=0;
    $socio->insert();
    sendRequestEmail($socio);
    echo "Thank you " . $socio->firstname . " your request is being processed. You will receive a confirmation email to " . $socio->email . ". Club Eurpeo office will contact you soon in order to complete the renewal process.";
}

else {echo "Dati non validi";}


function sendRequestEmail($socio) {
    $headers="From: <info@clubeuropeo.it>\n";
    $msg_body = "Hello " . $socio->firstname . " " . $socio->lastname . ",";
    $headers .= $msg_body;
    $oggetto="Renewal Request - Club Europeo Ispra";
    $corpo="You receive this because you requested a renewal membership to Club Europeo Ispra for the current year. Club Eurpeo office will contact you soon in order to complete the renewal process. "
        . "In case you are receiving this email by mistake please reply on this address." . " Club Europeo Ispra.";

    mail($socio->email, $oggetto, $corpo, $headers);
}

