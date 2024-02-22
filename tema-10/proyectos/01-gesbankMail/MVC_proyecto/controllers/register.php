<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'auth.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Register extends Controller
{

    public function render()
    {

        # iniciamos o continuar sessión
        session_start();

        # Si existe algún mensaje 
        if (isset($_SESSION['mensaje'])) {

            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);

        }

        # Inicializamos los campos del formulario
        $this->view->name = null;
        $this->view->email = null;
        $this->view->password = null;

        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION['error'];
            unset($_SESSION['error']);

            # Variables de autorrelleno
            $this->view->name = $_SESSION['name'];
            $this->view->email = $_SESSION['email'];
            $this->view->password = $_SESSION['password'];
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);

            # Tipo de error
            $this->view->errores = $_SESSION['errores'];
            unset($_SESSION['errores']);

        }

        $this->view->render('register/index');
    }


    public function validate()
    {

        # Iniciamos o continuamos con la sesión
        session_start();

        # Saneamos el formulario
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password-confirm'], FILTER_SANITIZE_SPECIAL_CHARS);

        # Validaciones

        $errores = array();

        # Validar name
        if (empty($name)) {
            $errores['name'] = "Campo Obligatorio";
        } else if (!$this->model->validateName($name)) {
            $errores['name'] = "Nombre de usuario no válido";
        }

        # Validar Email
        if (empty($email)) {
            $errores['email'] = "Campo Obligatorio.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email: Email no válido";
        } elseif (!$this->model->validateEmailUnique($email)) {
            $errores['email'] = "Email existente, ya está registrado";
        }

        # Validar password
        if (empty($password)) {
            $errores['password'] = "Debe introducir una contraseña.";
        } else if (strcmp($password, $password_confirm) !== 0) {
            $errores['password'] = "Password no coincidentes";
        } else if (!$this->model->validatePass($password)) {
            $errores['password'] = "Password: No permitido";
        }

        if (!empty($errores)) {

            $_SESSION['errores'] = $errores;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['error'] = "Fallo en la validación del formulario";

            header("location:" . URL . "register");

        } else {

            # Añade nuevo usuario
            $this->model->crear($name, $email, $password);

            $mail = new PHPMailer(true);
            try {

                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";

                // Credenciales SMPT gmail
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;

                // Configurar el servidor SMTP
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

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

                $mail->isHTML(true);
                $mail->setFrom($destinatario, $name);
                $mail->addAddress($remitente, 'Jorge Coronil Villalba');
                $mail->addReplyTo($destinatario, $name);
                $mail->Subject = 'Bienvenid@ a Gesbank';
                $mail->Body = 'El registro ha sido todo un éxito. Sus credenciales son: <br>' .
                    '<b>Nombre</b>: ' . $name . '<br>' .
                    '<b>Email</b>: ' . $email . '<br>' .
                    '<b>Contraseña</b>: ' . $password . ' <br>' .
                    'Gracias por registrarte.';

                // Enviar el correo electrónico
                $mail->send();
            } catch (Exception $e) {
                echo "No se pudo enviar el correo electrónico: {$mail->ErrorInfo}";
            }

            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            #Vuelve login
            header("location:" . URL . "login");
        }



    }

}

?>