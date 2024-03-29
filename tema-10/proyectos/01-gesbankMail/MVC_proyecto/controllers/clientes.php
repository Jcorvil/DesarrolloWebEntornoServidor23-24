<?php
require_once 'class/class.cliente.php';
require_once 'class/class.pdfClientes.php';


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

            # Autorrellenar el formulario con los detalles de la cliente
            $this->view->cliente = unserialize($_SESSION['cliente']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cliente']);
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
        } elseif ($this->model->existeEmail($email, $cliente->id)) {
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
        } elseif ($this->model->existeDNI($dni, $cliente->id)) {
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
        } else {

            // Añadir registro a la tabla
            $this->model->create($cliente);

            // Añadimos a la variable de sesión un mensaje
            $_SESSION['mensaje'] = 'Cliente creado correctamente';

            // Redirigimos al main de clientes
            header('location:' . URL . 'clientes');
        }
    }


    function edit($param = [])
    {
        session_start();

        # obtengo el id del cliente que voy a edit
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
        $this->view->title = "Edit - Panel de control Clientes";

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

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        # Cargo id del cliente
        $id = $param[0];

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
        } elseif ($this->model->existeEmail($email, $id)) {
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
        } elseif ($this->model->existeDNI($dni, $id)) {
            $errores['dni'] = 'Este DNI ya está registrado';
        }
        # comprobamos la validación
        if (!empty($errores)) {
            // Errores de validación
            $_SESSION['cliente'] = serialize($cliente);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos
            header('location:' . URL . 'clientes/edit/' . $id);
            exit();
        }
        // Actualizamos el registro
        $this->model->update($id, $cliente);

        // Añadimos a la variable de sesión un mensaje
        $_SESSION['mensaje'] = 'Cliente actualizado correctamente';

        // Redireccionamos al main de clientes
        header("Location:" . URL . "clientes");

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
        # Inicio o continúo la sesión
        session_start();

        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        } else {
            //Obteneemos id del cliente
            $idCliente = $param[0];

            // Obtener todas las cuentas asociadas al cliente
            $cuentasDelCliente = $this->model->getCuentasCliente($idCliente);

            // Eliminar cada cuenta asociada al cliente
            foreach ($cuentasDelCliente as $cuenta) {
                $this->model->deleteCuentas($cuenta->id);
            }

            // Eliminar el cliente
            $this->model->delete($idCliente);

            //Generar mensaje
            $_SESSION['notify'] = 'Clientes y sus cuentas borrados.';

            header("Location:" . URL . "clientes");
        }
    }


    // Al descargar el archivo importado éste no se muestra hasta que se actualiza la carpeta (cerrar y abrir o
    // actualizar el escritorio.)
    function export()
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['export']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
        }

        $clientes = $this->model->getCSV();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="clientes.csv"');

        $ficheroExport = fopen('php://output', 'w');

        foreach ($clientes as $cliente) {

            fputcsv($ficheroExport, $cliente, ';');
        }

        fclose($ficheroExport);
    }


    function import()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['import']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo_csv"]) && $_FILES["archivo_csv"]["error"] == UPLOAD_ERR_OK) {
            $file = $_FILES["archivo_csv"]["tmp_name"];

            $handle = fopen($file, "r");

            if ($handle !== FALSE) {
                // Iterar sobre el archivo CSV y procesar cada línea
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Obtener los datos de cada fila y guardarlos en variables
                    $apellidos = $data[0];
                    $nombre = $data[1];
                    $email = $data[2];
                    $telefono = $data[3];
                    $ciudad = $data[4];
                    $dni = $data[5];

                    // Verificar si ya existe un cliente con el mismo correo electrónico (email) o número de identificación (DNI),
                    // ya que no se pueden repetir.
                    if (!$this->model->existeEmail($email) && !$this->model->existeDNI($dni)) {
                        // Si no existe, crear un nuevo cliente
                        $cliente = new classCliente();
                        $cliente->apellidos = $apellidos;
                        $cliente->nombre = $nombre;
                        $cliente->email = $email;
                        $cliente->telefono = $telefono;
                        $cliente->ciudad = $ciudad;
                        $cliente->dni = $dni;

                        // Insertar el cliente en la base de datos
                        $this->model->create($cliente);
                    } else {
                        // Si ya existe, se ignora el cliente
                        echo "El cliente con correo electrónico $email o DNI $dni ya existe en la base de datos. Se ha ignorado el cliente.";
                    }
                }

                fclose($handle);
                $_SESSION['mensaje'] = "Importación completada correctamente";
                header('location:' . URL . 'clientes');
                exit();

            } else {
                $_SESSION['error'] = "Error al abrir el archivo CSV";
                header('location:' . URL . 'clientes');
                exit();

            }

        } else {
            $_SESSION['error'] = "No se ha seleccionado ningún archivo CSV";
            header('location:' . URL . 'clientes');
            exit();
        }
    }

    function pdf()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
            exit();
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['pdf']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'clientes');
            exit();
        }

        // Obtener los datos de los clientes
        $clientes = $this->model->get();

        // Crear instancia de pdfClientes
        $pdf = new pdfClientes();

        // Se puede establecer el comienzo de la tabla casi al final de la página para comprobar que
        // el salto de línea y el encabezado automático funcionan correctamente.
        // $pdf->SetY(260);

        // Agregar contenido al PDF
        $pdf->contenido($clientes);

        // Salida del PDF
        $pdf->Output();
    }


}

?>