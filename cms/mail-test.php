<?
$headers="From: <info@clubeuropeo.it>\n";
$msg_body = "Questo messaggio è un test";
$headers .= $msg_body;
$oggetto="Test invio mail";
$corpo="Mail di test !!!";

mail("brena.giovanni@gmail.com", $oggetto, $corpo, $headers);
?>