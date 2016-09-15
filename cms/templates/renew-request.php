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
    echo "Grazie " . $socio->firstname . " la tua richiesta è stata processata. Riceverai a breve una mail di conferma all'indirizzo " . $socio->email . ". L'ufficio del Club Europeo ti ricontatterà presto per concludere la procedura di rinnovo.";
}

else {echo "Dati non validi";}


function sendRequestEmail($socio) {
    $headers="From: <info@clubeuropeo.it>\n";
    $msg_body = "Buongiorno " . $socio->firstname . " " . $socio->lastname . ",";
    $headers .= $msg_body;
    $oggetto="Richiesta Rinnovo - Club Europeo Ispra";
    $corpo="ricevi questo messaggio perchè hai richiesto il rinnovo dell'iscrizione al Club Europeo di Ispra per l'anno in corso. L'ufficio del Club ti ricontatterà a breve su questo indirizzo per completare la procedura di rinnovo. "
        . "Nel caso questa mail ti sia arrivata senza che tu abbia richiesto l'iscrizione puoi comunicarlo rispondendo a questo messaggio." . " Club Europeo Ispra.";

    mail($socio->email, $oggetto, $corpo, $headers);
}

