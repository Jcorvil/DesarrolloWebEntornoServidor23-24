<?php

// Procesar email con PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Creo objeto clase PHPMailer
$mail = new PHPMailer(true);

// En caso de error lanza Exception
try {

    // Configuración juego caracteres
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "quoted-printable";

    // Credenciales SMPT gmail
    $mail->Username = 'coronilvjorge@gmail.com';
    $mail->Password = 'lmcj gzso ovqg kzos';

    // Configuración SMPT gmail
    $mail->SMTPDebug = 2;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // tls Enable implicit TLS encryption
    $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Cabecera del emial
    $destinatario = 'coronilvjorge@gmail.com';
    $remitente = 'coronilvjorge@gmail.com';
    $asunto = "Email con PHPMailer";
    $mensaje = file_get_contents('email/email.html');       // Extrae los contenidos del email del archivo especificado

    $mail->setFrom($remitente, 'Jorge');
    $mail->addAddress($destinatario, 'Jorge');
    $mail->addReplyTo($remitente, 'Jorge');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('files/astronaut.jpg');         //Add attachments
    // $mail->addAttachment('files/pikachu_sm.jpg');         //Optional name
    // $mail->addAttachment('files/vagabundo.jpg');         //Optional name


    // Se pone la ruta de la imagen y el nombre que tenga el cid en el html.
    $mail->addEmbeddedImage('email/images/astronaut.jpg', 'astronauta'); 


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->msgHTML($mensaje);

    // Enviamos el mensaje
    $mail->send();

    echo 'Message has been sent';

} catch (Exception $e) {

    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}