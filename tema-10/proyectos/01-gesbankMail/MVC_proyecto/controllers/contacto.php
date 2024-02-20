<?php

require_once 'class/class.contacto.php';

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


        # Comprobar si existe el mensaje
        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        // Mostrar el formulario de contacto
        $this->view->render('contacto/index');


    }

    function validar()
    {

        // 1. Seguridad. Saneamos los datos del formulario
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_SPECIAL_CHARS);
        $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

        # Cargamos los datos del formulario
        $contacto = new classContacto(
            $nombre,
            $email,
            $asunto,
            $mensaje
        );

        // Validar el formulario de contacto
        $errores = [];

        // Validar campos obligatorios
        if (empty($_POST['nombre'])) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        }

        if (empty($_POST['email'])) {
            $errores['email'] = 'El correo electrónico es obligatorio.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El correo electrónico no es válido.';
        }

        if (empty($_POST['asunto'])) {
            $errores['asunto'] = 'El asunto es obligatorio.';
        }

        if (empty($_POST['mensaje'])) {
            $errores['mensaje'] = 'El mensaje es obligatorio.';
        }

        // Comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['cliente'] = serialize($contacto);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos al formulario
            header('Location:' . URL . 'contacto');
            exit();

        } else {
            // Enviar el correo electrónico
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto'];
            $mensaje = $_POST['mensaje'];

            // Configurar SMTP de Gmail
            // (Es necesario habilitar el acceso de aplicaciones menos seguras en la cuenta de Gmail)
            $mail = new PHPMailer(true);
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tu_correo@gmail.com'; // Cambiar por tu dirección de correo de Gmail
            $mail->Password = 'tu_contraseña'; // Cambiar por tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo electrónico
            $mail->setFrom('tu_correo@gmail.com', 'Jorge'); // Cambiar por tu dirección de correo y nombre
            $mail->addAddress('correo_destino@example.com', 'Nombre Destinatario'); // Cambiar por la dirección de correo del destinatario
            $mail->Subject = 'Mensaje de contacto';
            $mail->Body = "Nombre: $nombre\nCorreo electrónico: $email\nMensaje: $mensaje";

            try {
                // Enviar correo electrónico
                $mail->send();
                // Mostrar mensaje de éxito
                $this->view->mensaje = "Mensaje enviado correctamente.";
                $this->view->render('contacto/exito');
            } catch (Exception $e) {
                // Mostrar mensaje de error si falla el envío
                $this->view->error = "Error al enviar el mensaje: {$mail->ErrorInfo}";
                $this->render();
            }
        }
    }
}

?>