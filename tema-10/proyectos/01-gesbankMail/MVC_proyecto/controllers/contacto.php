<?php

require_once 'class/class.contacto.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/auth.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Contacto extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {


        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        $this->view->render('contacto/index');

    }

    function validar()
    {
        // Obtener los datos del formulario
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $remitente = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_SPECIAL_CHARS);
        $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

        $contacto = new classContacto(
            $nombre,
            $remitente,
            $asunto,
            $mensaje
        );

        $errores = [];

        if (empty($nombre)) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if (empty($remitente)) {
            $errores['email'] = 'El correo electrónico es obligatorio.';
        } elseif (!filter_var($remitente, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El correo electrónico no es válido.';
        }

        if (empty($asunto)) {
            $errores['asunto'] = 'El asunto es obligatorio.';
        }

        if (empty($mensaje)) {
            $errores['mensaje'] = 'El mensaje es obligatorio.';
        }

        if (!empty($errores)) {
            // Si hay errores, redirigir de nuevo al formulario de contacto con los errores
            $_SESSION['contacto'] = serialize($contacto);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            header('Location:' . URL . 'contacto');
            exit();
        } else {
            try {
                $mail = new PHPMailer(true);

                // Configuración juego caracteres
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";

                // Credenciales SMTP. Se encuentra en auth.php dentro de PHPMailer
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;

                // Configuración SMPT gmail
                $mail->SMTPDebug = 2;                                       //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication                             //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // tls Enable implicit TLS encryption
                $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Capturando el remitente y el asunto del formulario
                $remitente = $_POST['email'];
                $asunto = $_POST['asunto'];

                // Contenido del correo electrónico
                $mail->setFrom($remitente, $nombre);
                $mail->addAddress(SMTP_USER);
                $mail->addReplyTo($remitente);

                // Contenido
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $asunto;
                $mail->Body = $mensaje;

                // Enviar correo electrónico
                $mail->send();

                // Redirigir a la página de éxito
                $_SESSION['mensaje'] = 'Mensaje enviado correctamente.';
                header('Location:' . URL . 'index');
                exit();
            } catch (Exception $e) {
                // Manejar excepciones
                $_SESSION['error'] = 'Error al enviar el mensaje: ' . $mail->ErrorInfo;
                header('Location:' . URL . 'contacto');
                exit();
            }
        }
    }

}

?>