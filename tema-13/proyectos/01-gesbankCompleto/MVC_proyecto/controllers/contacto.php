<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'auth.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class Contacto extends Controller
{

    public function render()
    {
        session_start();

        # Comprobar si vuelvo de un registro no validado
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);

        }

        # Comprobar si existe el mensaje
        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        $this->view->title = "Página de contacto";

        $this->view->render('contacto/index');
    }

    public function validar()
    {

        session_start();

        // Procesar el formulario de contacto
        $nombre = filter_var($_POST['nombre'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $asunto = filter_var($_POST['asunto'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $mensaje = filter_var($_POST['mensaje'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validar campos
        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre obligatorio';
        }

        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Formato incorrecto';
        }

        if (empty($asunto)) {
            $errores['asunto'] = 'Asunto obligatorio';
        }

        if (empty($mensaje)) {
            $errores['mensaje'] = 'Mensaje obligatorio';
        }

        if (!empty($errores)) {

            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redirigir después del envío
            header("Location: " . URL . "contacto");
            exit();
        } else {

            $mail = new PHPMailer(true);
            try {
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";

                // Credenciales SMPT gmail
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;

                // Configuración SMPT gmail
                $mail->SMTPDebug = 2;                                       //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication                             //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // tls Enable implicit TLS encryption
                $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                // Desactiva la verificación del certificado SSL de SMTP en PHPMailer
                // Sin este comando, se bloquea el envío de correos de Gmail
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                //Cabecera del email
                $remitente = SMTP_USER;
                $destinatario = $email;

                $mail->setFrom($destinatario, $nombre);
                $mail->addAddress($remitente, 'Jorge Coronil Villalba');
                $mail->addReplyTo($destinatario, $nombre);

                //Content
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;

                // Enviamos el mensaje
                $mail->send();

                $_SESSION['mensaje'] = "Mensaje enviado correctamente";

                header("Location: " . URL . "contacto");
                exit();

            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";

            }
        }
    }
}

?>