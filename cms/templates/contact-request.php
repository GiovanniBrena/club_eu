<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 29/08/16
 * Time: 17:25
 */
require( "../config.php" );

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$message = $_POST['message'];

sendContactEmail($firstname, $lastname, $email, $message);


function sendContactEmail($firstname, $lastname, $email, $message) {
    $headers="From: " . $email . "\n";
    $msg_body = "Messaggio ricevuto da: " . $firstname . " " . $lastname . " data: " . date('d-m-Y H:i');
    $headers .= $msg_body;
    $oggetto="Messaggio da modulo contatti CLUB EUROPEO";
    $corpo=$message;
    mail("brena.giovanni@gmail.com", $oggetto, $corpo, $headers);
}


