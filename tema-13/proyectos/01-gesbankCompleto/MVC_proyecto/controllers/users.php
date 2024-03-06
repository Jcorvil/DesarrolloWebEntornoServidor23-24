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

        # obtener objeto de la clase user
        $this->view->user = $this->model->read($id);

        # Comprobar si vuelvo de un registro no validado
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles de la user
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
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        # Cargamos los datos del formulario
        $user = new classUser(
            null,
            $nombre,
            $email,
            $password
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
            $this->model->create($user);

            // Añadimos a la variable de sesión un mensaje
            $_SESSION['mensaje'] = 'user creado correctamente';

            // Redirigimos al main de users
            header('location:' . URL . 'users');
        }
    }


    function edit($param = [])
    {
        session_start();

        # obtengo el id del user que voy a edit
        // user/edit/4

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
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);
        $ciudad = filter_input(INPUT_POST, 'ciudad', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_SPECIAL_CHARS);

        # Cargamos los datos del formulario
        $user = new classUser(
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
            $errores['nombre'] = 'Nombre del user obligatorio';
        } elseif (strlen($nombre) > 20) {
            $errores['nombre'] = 'El nombre no puede tener más de 20 caracteres';
        }

        // Apellidos
        if (empty($apellidos)) {
            $errores['apellidos'] = 'Apellidos del user obligatorio';
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
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos
            header('location:' . URL . 'users/edit/' . $id);
            exit();
        }
        // Actualizamos el registro
        $this->model->update($id, $user);

        // Añadimos a la variable de sesión un mensaje
        $_SESSION['mensaje'] = 'user actualizado correctamente';

        // Redireccionamos al main de users
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
        $this->view->title = "Detalles del user";
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
            //Obteneemos id del user
            $iduser = $param[0];

            // Obtener todas las cuentas asociadas al user
            $cuentasDeluser = $this->model->getCuentasuser($iduser);

            // Eliminar cada cuenta asociada al user
            foreach ($cuentasDeluser as $cuenta) {
                $this->model->deleteCuentas($cuenta->id);
            }

            // Eliminar el user
            $this->model->delete($iduser);

            //Generar mensaje
            $_SESSION['notify'] = 'users y sus cuentas borrados.';

            header("Location:" . URL . "users");
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['export']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
        }

        $users = $this->model->getCSV();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');

        $ficheroExport = fopen('php://output', 'w');

        foreach ($users as $user) {

            fputcsv($ficheroExport, $user, ';');
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['import']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
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

                    // Verificar si ya existe un user con el mismo correo electrónico (email) o número de identificación (DNI),
                    // ya que no se pueden repetir.
                    if (!$this->model->existeEmail($email) && !$this->model->existeDNI($dni)) {
                        // Si no existe, crear un nuevo user
                        $user = new classUser();
                        $user->apellidos = $apellidos;
                        $user->nombre = $nombre;
                        $user->email = $email;
                        $user->telefono = $telefono;
                        $user->ciudad = $ciudad;
                        $user->dni = $dni;

                        // Insertar el user en la base de datos
                        $this->model->create($user);
                    } else {
                        // Si ya existe, se ignora el user
                        echo "El user con correo electrónico $email o DNI $dni ya existe en la base de datos. Se ha ignorado el user.";
                    }
                }

                fclose($handle);
                $_SESSION['mensaje'] = "Importación completada correctamente";
                header('location:' . URL . 'users');
                exit();

            } else {
                $_SESSION['error'] = "Error al abrir el archivo CSV";
                header('location:' . URL . 'users');
                exit();

            }

        } else {
            $_SESSION['error'] = "No se ha seleccionado ningún archivo CSV";
            header('location:' . URL . 'users');
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['user']['pdf']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'users');
            exit();
        }

        // Obtener los datos de los users
        $users = $this->model->get();

        // Crear instancia de pdfusers
        $pdf = new pdfusers();

        // Se puede establecer el comienzo de la tabla casi al final de la página para comprobar que
        // el salto de línea y el encabezado automático funcionan correctamente.
        // $pdf->SetY(260);

        // Agregar contenido al PDF
        $pdf->contenido($users);

        // Salida del PDF
        $pdf->Output();
    }


}

?>