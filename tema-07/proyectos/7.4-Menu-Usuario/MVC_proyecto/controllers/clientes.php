<?php
require_once 'class/class.cliente.php';


class Clientes extends Controller
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        } else {

            # Comprobar si existe el mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            # Creo la propiedad title de la vista
            $this->view->title = "Tabla Clientes";

            # Creo la propiedad clientes dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->clientes = $this->model->get();
            $this->view->render("clientes/main/index");
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        # obtener objeto de la clase cliente
        $this->view->cliente = $this->model->read($id);

        # Comprobar si vuelvo de un registro no validado
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles de la cuenta
            $this->view->cuenta = unserialize($_SESSION['cuenta']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cuenta']);
        }

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión clientes";

        # cargo la vista con el formulario nuevo cliente
        $this->view->render('clientes/new/index');
    }

    function create($param = [])
    {
        // Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        // 1. Seguridad. Saneamos los datos del formulario
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);
        $ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_SPECIAL_CHARS);

        # Cargamos los datos del formulario
        $cliente = new classCliente(
            null,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            $ciudad,
            $dni
        );

        // Validación
        $errores = [];

        // Nombre
        if (empty($nombre)) {
            $errores['nombre'] = 'Nombre del cliente obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        // Apellidos
        if (empty($apellidos)) {
            $errores['apellidos'] = 'Apellidos del cliente obligatorio';
        } elseif (strlen($apellidos) > 45) {
            $errores['apellidos'] = 'Los apellidos no pueden tener más de 45 caracteres';
        }

        // Email
        if (empty($email)) {
            $errores['email'] = 'Email obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Email inválido';
        } elseif ($this->model->existeEmail($email)) {
            $errores['email'] = 'Este email ya está registrado';
        }

        // Teléfono
        if (!empty($telefono) && strlen($telefono) != 9) {
            $errores['telefono'] = 'El teléfono debe tener exactamente 9 dígitos';
        }

        // Ciudad
        if (empty($ciudad)) {
            $errores['ciudad'] = 'Ciudad obligatoria';
        } elseif (strlen($ciudad) > 20) {
            $errores['ciudad'] = 'La ciudad no puede tener más de 20 caracteres';
        }

        // Dni
        if (empty($dni)) {
            $errores['dni'] = 'DNI obligatorio';
        } elseif (!preg_match('/^\d{8}[A-Z]$/', $dni)) {
            $errores['dni'] = 'El DNI debe tener 8 dígitos seguidos de una letra mayúscula';
        } elseif ($this->model->existeDNI($dni)) {
            $errores['dni'] = 'Este DNI ya está registrado';
        }

        // Comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            // Transforma el objeto cliente en un string
            $_SESSION['cliente'] = serialize($cliente);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos a new
            header('Location:' . URL . 'clientes/new');
            exit();
        }

        // Añadir registro a la tabla
        $this->model->create($cliente);

        // Redirigimos al main de clientes
        header('location:' . URL . 'clientes');
    }


    function edit($param = [])
    {
        session_start();

        # obtengo el id del cliente que voy a editar
        // cliente/edit/4

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Editar - Panel de control Clientes";

        # obtener objeto de la clase cliente
        $this->view->cliente = $this->model->read($id);

        //Comprobar si el formulario viene de una validación
        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION['error'];


            # Autorrellenar el formulario con los detalles del cliente
            $this->view->cliente = unserialize($_SESSION['cliente']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cliente']);
        }

        # cargo la vista
        $this->view->render('clientes/edit/index');

    }

    function update($param = [])
    {

        session_start();

        # Cargo id del cliente
        $id = $param[0];

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        # Con los detalles del formulario creo objeto cliente
        $cliente = new classCliente(
            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
        );

        $this->model->update($id, $cliente);

        header('location:' . URL . 'clientes');

    }

    function show($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        // Obtengo la id del cliente que quiero mostrar
        $id = $param[0];

        // Obtengo los datos del cliente mediante el modelo
        $cliente = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles del Cliente";
        $this->view->cliente = $cliente;

        // Cargo la vista de detalles del cliente
        $this->view->render('clientes/show/index');

    }


    function order($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        # Obtengo el criterio de ordenación
        $criterio = $param[0];

        # Creo la propiedad "title" de la vista
        $this->view->title = "Ordenar - Panel de Control Clientes";

        # Creo la propiedad clientes dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get()
        $this->view->clientes = $this->model->order($criterio);

        # Cargo la vista principal de clientes
        $this->view->render('clientes/main/index');

    }

    function filter($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión Clientes";

        //Creamos la variable clientes dentro de la vista
        //Esta variable ejecuta el método get() del modelo clientesModel
        $this->view->clientes = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('clientes/main/index');
    }

    function delete($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        // Obtengo la id del cliente que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id del cliente
        $this->model->delete($id);

        // Cargo de nuevo la vista clientes actualizada
        header('location:' . URL . 'clientes');
    }


}

?>