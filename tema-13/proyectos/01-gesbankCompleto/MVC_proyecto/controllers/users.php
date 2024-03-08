<?php
require_once 'class/class.user.php';


class Users extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render($param = [])
    {

        # Inicio o continúo la sesión
        session_start();

        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        } else {

            # Comprobar si existe el mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            $this->view->model = $this->model;
            # Creo la propiedad title de la vista
            $this->view->title = "Tabla Usuarios";

            # Creo la propiedad users dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->users = $this->model->get();
            $this->view->render("users/main/index");
        }
    }

    function new()
    {
        # Iniciar o continuar sesión
        session_start();

        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        // Obtener los roles
        $roles = $this->model->getRoles();

        // Pasar los roles a la vista
        $this->view->roles = $roles;

        # Comprobar si vuelvo de un registro no validado
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles del usuario
            $this->view->user = unserialize($_SESSION['user']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['user']);
        }

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión Usuarios";

        # cargo la vista con el formulario nuevo user
        $this->view->render('users/new/index');
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
        $rol = filter_var($_POST['rol'], FILTER_SANITIZE_SPECIAL_CHARS);

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

        # Validar rol
        if (empty($rol)) {
            $errores['rol'] = "Debe seleccionar un rol.";
        }

        if (!empty($errores)) {

            $_SESSION['errores'] = $errores;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['error'] = "Fallo en la validación del formulario";

            header("location:" . URL . "users/new");

        } else {

            # Añade nuevo usuario
            $this->model->crear($name, $email, $password, $rol);

            $_SESSION['mensaje'] = "Usuario registrado correctamente";

            header("location:" . URL . "users");
            exit();
        }

    }


    function create($param = [])
    {
        // Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        // 1. Seguridad. Saneamos los datos del formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        # Cargamos los datos del formulario
        $user = new classUser(
            null,
            $nombre,
            $email,
            $password,
            $rol
        );

        // Validación
        $errores = [];

        // Nombre
        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre del usuario obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        // Email
        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email inválido';
        } elseif ($this->model->existeEmail($email, $user->id)) {
            $errores['email'] = 'Este email ya está registrado';
        }

        // Password
        if (empty($password)) {
            $errores['password'] = 'Contraseña obligatoria';
        } elseif (!filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $errores['password'] = 'Contraseña inválida';
        }

        // Rol
        if (empty($rol)) {
            $errores['rol'] = 'Rol obligatorio';
        }

        // Comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            // Transforma el objeto user en un string
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos a new
            header('Location:' . URL . 'users/new');
            exit();
        } else {

            // Añadir registro a la tabla
            $this->model->crear($user);

            // Añadimos a la variable de sesión un mensaje
            $_SESSION['mensaje'] = 'Usuario creado correctamente';

            // Redirigimos al main de users
            header('location:' . URL . 'users');
        }
    }


    function edit($param = [])
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Edit - Panel de control users";

        # obtener objeto de la clase user
        $this->view->user = $this->model->read($id);

        // Obtener los roles
        $this->view->roles = $this->model->getRoles();

        //Comprobar si el formulario viene de una validación
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles del user
            $this->view->user = unserialize($_SESSION['user']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['user']);
        }

        # cargo la vista
        $this->view->render('users/edit/index');

    }


    function update($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        # Cargo id del user
        $id = $param[0];

        // 1. Seguridad. Saneamos los datos del formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $rol = filter_var($_POST['rol'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        # Cargamos los datos del formulario
        $user = new classUser(
            null,
            $nombre,
            $email,
            $password,
            $rol
        );

        // Validación
        $errores = [];

        // Nombre
        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre del usuario obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        // Email
        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email inválido';
        } elseif ($this->model->validateEmailUnique($email, $user->id)) {
            $errores['email'] = 'Este email ya está registrado';
        }

        // Password
        if (!empty($password) && !$this->model->validatePass($password)) {
            $errores['password'] = 'Contraseña no válida';
        }

        // Confirmar password
        $password_confirm = filter_var($_POST['password-confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($password) && $password !== $password_confirm) {
            $errores['password-confirm'] = 'Las contraseñas no coinciden';
        }

        // Rol
        if (empty($rol)) {
            $errores['rol'] = 'Rol obligatorio';
        }

        # comprobamos la validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos
            header('location:' . URL . 'users/edit/' . $id);
            exit();
        }

        $this->model->update($id, $user);

        $_SESSION['mensaje'] = 'Usuario actualizado correctamente';

        header("Location:" . URL . "users");

    }

    function show($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        // Obtengo la id del user que quiero mostrar
        $id = $param[0];

        // Obtengo los datos del user mediante el modelo
        $user = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles del Usuario";
        $this->view->user = $user;

        // Cargo la vista de detalles del user
        $this->view->render('users/show/index');

    }


    function order($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        # Obtengo el criterio de ordenación
        $criterio = $param[0];

        # Creo la propiedad "title" de la vista
        $this->view->title = "Ordenar - Panel de Control users";

        # Creo la propiedad users dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get()
        $this->view->users = $this->model->order($criterio);

        # Cargo la vista principal de users
        $this->view->render('users/main/index');

    }

    function filter($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión users";

        //Creamos la variable users dentro de la vista
        //Esta variable ejecuta el método get() del modelo usersModel
        $this->view->users = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('users/main/index');
    }

    function delete($param = [])
    {
        # Inicio o continúo la sesión
        session_start();

        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {

            $_SESSION['mensaje'] = "Usuario No Autentificado";
            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');

        } else {

            //Obtenemos id del user
            $iduser = $param[0];

            // Eliminar el user
            $this->model->delete($iduser);

            //Generar mensaje
            $_SESSION['notify'] = 'Usuario eliminado.';

            header("Location:" . URL . "users");
        }
    }


}

?>