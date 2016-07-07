<?php
$to      = 'brena.giovanni@gmail.com';
$subject = 'CLUB EU Mail Test';
$message = 'Ciao questa è una prova di mail';
$headers = 'From: webmaster@clubeu.com' . "\r\n" .
    'Reply-To: webmaster@clubeu.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

echo (mail($to, $subject, $message, $headers));
?>