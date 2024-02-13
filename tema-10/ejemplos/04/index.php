<?php

// Cargar clase PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/PHPMailer/src/Exception.php';
require '/PHPMailer/src/PHPMailer.php';
require '/PHPMailer/src/SMTP.php';


try {

    // Creo un objeto de la clase PHPMailer
    $mail = new PHPMailer(true);

    // Configuración juego caracteres
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = "quoted-printable";

    $mail->Username = "coronilvjorge@gmail.com";
    $mail->Password = "";

    //Configuración SPMT gmail
    $mail->SMTPDebug = 2;                                       //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                     //Enable SMTP authentication
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 587;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Cabecera del email
    $destinatario = 'jcorvil600@g.educaand.es';
    $remitente = 'coronilvjorge@gmail.com';
    $asunto = 'Email con PHPMailer';
    $mensaje = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    $mail->setFrom($remitente, '<' . $remitente . '>');
    $mail->addAddress($destinatario, '<' . $destinatario . '>');
    $mail->addReplyTo($remitente, '<' . $remitente . '>');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    $mail->send();
    echo 'Mensaje enviado correctamente';

} catch (exception $e) {

}


?>