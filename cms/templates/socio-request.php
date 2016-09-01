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
    $msg_body = "Buongiorno " . $socio->firstname . " " . $socio->lastname . ",";
    $headers .= $msg_body;
    $oggetto="Richiesta Iscrizione - Club Europeo Ispra";
    $corpo="ricevi questo messaggio perchè hai richiesto l'associazione al Club Europeo di Ispra. L'ufficio del Club ti ricontatterà a breve su questo indirizzo per completare la procedura di iscrizione. "
        . "Nel caso questa mail ti sia arrivata senza che tu abbia richiesto l'iscrizione puoi comunicarlo rispondendo a questo messaggio." . " Club Europeo Ispra.";

    mail($socio->email, $oggetto, $corpo, $headers);
}


