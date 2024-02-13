<?php
require_once 'class/class.cuenta.php';


class Cuentas extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # Inicio o continúo la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        } else {

            # Comprobar si existe el mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            # Creo la propiedad title de la vista
            $this->view->title = "Tabla de cuentas";

            # Creo la propiedad cuentas dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->cuentas = $this->model->get();

            $this->view->render('cuentas/main/index');
        }
    }

    function new($param = [])
    {

        # Iniciar o continuar sesión
        session_start();


        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }
        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión cuentas";

        $cuentaModel = new cuentasModel();
        $cuentasDisponibles = $cuentaModel->get();


        $listacuentas = [];
        foreach ($cuentasDisponibles as $cuenta) {
            $nombreCompleto = $cuenta->cuenta . ', ';
            $listacuentas[$cuenta->id] = $nombreCompleto;
        }

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


        $this->view->cuentas = $listacuentas;

        # cargo la vista con el formulario nuevo cuenta
        $this->view->render('cuentas/new/index');
    }

    function create($param = [])
    {

        # Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        # 1. Seguridad. Saneamos los datos del formulario
        $num_cuenta = filter_input(INPUT_POST, 'num_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $id_cuenta = filter_input(INPUT_POST, 'id_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_input(INPUT_POST, 'fecha_alta', FILTER_SANITIZE_SPECIAL_CHARS);
        // $fecha_ul_mov = filter_input(INPUT_POST, 'fecha_ul_mov', FILTER_SANITIZE_SPECIAL_CHARS);
        // $num_movtos = filter_input(INPUT_POST, 'num_movtos', FILTER_SANITIZE_NUMBER_INT);
        $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_NUMBER_INT);


        # 2. Creamos la cuenta con los datos saneados
        # Cargamos los datos del formulario
        $cuenta = new classCuenta(
            null,
            $num_cuenta,
            $id_cuenta,
            $fecha_alta,
            null,
            null,
            $saldo
        );

        # Validación
        $errores = [];

        $cuenta_regexp = [
            'options' => [
                'regexp' => '/^[0-9]{20}$/'
            ]
        ];

        // num_cuenta
        if (empty($num_cuenta)) {
            $errores['num_cuenta'] = 'El campo número de cuenta es obligatorio';
        } else if (!filter_var($num_cuenta, FILTER_VALIDATE_REGEXP, $cuenta_regexp)) {
            $errores['num_cuenta'] = 'El número de cuenta debe tener 20 números';
        } else if (!$this->model->existeCuenta($num_cuenta)) {
            $errores['num_cuenta'] = "El número de cuenta ya existe";
        }

        //id_cuenta. Campo obligatorio, valor numérico, debe existir en la tabla de cuentas
        if (empty($id_cuenta)) {
            $errores['id_cuenta'] = 'El campo cuenta es obligatorio';
        } else if (!filter_var($id_cuenta, FILTER_VALIDATE_INT)) {
            $errores['id_cuenta'] = 'Deberá introducir un valor númerico en este campo';
        } else if (!$this->model->getcuentaCuenta($id_cuenta)) {
            $errores['id_cuenta'] = 'El cuenta seleccionado no existe';
        }

        // fecha_alta
        if (empty($fecha_alta)) {
            $errores['fecha_alta'] = 'El campo fecha alta es obligatorio';
        } else if (!$this->model->validateFechaAlta($fecha_alta)) {
            $errores['fecha_alta'] = 'La fecha no tiene un formato correcto';
        }

        // // fecha_ul_mov
        // if (empty($fecha_ul_mov)) {
        //     $errores['fecha_ul_mov'] = 'Debe introducir una fecha';
        // }

        // num_movtos
        // if (empty($num_movtos)) {
        //     $errores['num_movtos'] = 'La cuenta debe tener al menos un movimiento';
        // }

        // saldo
        if (empty($saldo)) {
            $errores['saldo'] = 'El campo saldo es obligatorio';
        } else if (!is_numeric($saldo)) {
            $errores['saldo'] = 'El campo saldo debe ser numérico';
        }

        # 4. Comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            // transforma el objeto cuenta en un string
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a new
            header('Location:' . URL . 'cuentas/new');
            exit();
        } else {
            # Añadimos el registro a la tabla
            $this->model->create($cuenta);

            //Crearemos un mensaje, indicando que se ha realizado dicha acción
            $_SESSION['mensaje'] = "Cuenta creada correctamente.";

            // Redireccionamos a la vista principal de cuentas
            header("Location:" . URL . "cuentas");
        }
    }


    function edit($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        # Obtengo el valor del ID de la cuenta a editar
        $id = $param[0];

        # Creo una variable id en view y la igualo al valor del primer parámetro pasado
        $this->view->id = $id;

        $this->view->title = "Editar - Gestión Cuenta";

        # Obtener objeto de la clase cuenta
        $this->view->cuenta = $this->model->read($id);
        # Obtener los cuentas
        $this->view->cuentas = $this->model->getcuentaCuenta();

        // Obtener el cuenta asociado a la cuenta
        $cuentaId = $this->view->cuenta->id_cuenta;
        $this->view->cuenta = $this->model->getcuentaById($cuentaId);

        //Comprobar si el formulario viene de una validación
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

        # Obtener datos de los cuentas disponibles desde el modelo de cuentas
        $cuentaModel = new cuentasModel();
        $cuentasDisponibles = $cuentaModel->get();

        $cuentasConcatenados = [];
        foreach ($cuentasDisponibles as $cuenta) {
            $nombreCompleto = $cuenta->cuenta;
            $cuentasConcatenados[$cuenta->id] = $nombreCompleto;
        }

        // Ordenamos el array
        asort($cuentasConcatenados);

        $this->view->cuentas = $cuentasConcatenados;

        $this->view->render('cuentas/edit/index');
    }

    function update($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        # 1. Seguridad. Saneamos los datos del formulario
        $num_cuenta = filter_input(INPUT_POST, 'num_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $id_cuenta = filter_input(INPUT_POST, 'id_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_input(INPUT_POST, 'fecha_alta', FILTER_SANITIZE_SPECIAL_CHARS);
        // $fecha_ul_mov = filter_input(INPUT_POST, 'fecha_ul_mov', FILTER_SANITIZE_SPECIAL_CHARS);
        // $num_movtos = filter_input(INPUT_POST, 'num_movtos', FILTER_SANITIZE_NUMBER_INT);
        $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_NUMBER_INT);

        # 2. Creamos la cuenta con los datos saneados
        # Cargamos los datos del formulario
        $cuenta = new classCuenta(
            null,
            $num_cuenta,
            $id_cuenta,
            $fecha_alta,
            null,
            null,
            $saldo
        );

        # Cargo id de la cuenta
        $id = $param[0];

        # Obtengo el objeto alumno original
        $cuentaOG = $this->model->read($id);

        # Con los detalles del formulario creo objeto cuenta
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $_POST['id_cuenta'],
            $_POST['fecha_alta'],
            null,
            null,
            $_POST['saldo']
        );



        # 3. Validacion
        $errores = [];

        $cuenta_regexp = [
            'options' => [
                'regexp' => '/^[0-9]{20}$/'
            ]
        ];

        // num_cuenta
        if (strcmp($cuenta->num_cuenta, $cuentaOG->num_cuenta) !== 0) {
            if (empty($num_cuenta)) {
                $errores['num_cuenta'] = 'El Nº de la cuenta es obligatorio';
            } else if (!filter_var($num_cuenta, FILTER_VALIDATE_REGEXP, $cuenta_regexp)) {
                $errores['num_cuenta'] = 'El número de cuenta debe ser 20 números';
            } else if (!$this->model->existeCuenta($num_cuenta)) {
                $errores['num_cuenta'] = "El número de cuenta ya está registrado";
            }
        }

        // id_cuenta
        if (strcmp($cuenta->id_cuenta, $cuentaOG->id_cuenta) !== 0) {
            if (empty($id_cuenta)) {
                $errores['id_cuenta'] = 'El campo cuenta es obligatorio';
            } else if (!filter_var($id_cuenta, FILTER_VALIDATE_INT)) {
                $errores['id_cuenta'] = 'Debe introducir un cuenta';
            } else if (!$this->model->getcuentaCuenta($id_cuenta)) {
                $errores['id_cuenta'] = 'El cuenta seleccionado no existe';
            }
        }

        // fecha_alta
        if (strcmp($cuenta->id_cuenta, $cuentaOG->id_cuenta) !== 0) {
            if (empty($fecha_alta)) {
                $errores['fecha_alta'] = 'El campo fecha alta es obligatorio';
            } else if (!$this->model->validateFechaAlta($fecha_alta)) {
                $errores['fecha_alta'] = 'La fecha no tiene un formato correcto';
            }
        }

        // // fecha_ul_mov
        // $valores = explode('/', $fecha_ul_mov);
        // if (strcmp($cuenta->fecha_ul_mov, $cuentaOG->fecha_ul_mov) !== 0) {
        //     if (empty($fecha_ul_mov)) {
        //         $errores['fecha_ul_mov'] = 'Debe introducir una fecha de último movimiento';
        //     } else if (!checkdate($valores[1], $valores[0], $valores[2])) {
        //         $errores['fecha_ul_mov'] = 'Formato de fecha de último movimiento incorrecto';
        //     }
        // }

        // num_movtos
        // if (strcmp($cuenta->num_movtos, $cuentaOG->num_movtos) !== 0) {
        //     if (empty($num_movtos)) {
        //         $errores['num_movtos'] = 'La cuenta debe tener al menos un movimiento';
        //     }
        // }

        // saldo
        if (empty($saldo)) {
            $errores['saldo'] = 'El campo saldo es obligatorio';
        } else if (!is_numeric($saldo)) {
            $errores['saldo'] = 'El campo saldo debe ser numérico';
        }

        # 4. Comprobar validación

        if (!empty($errores)) {
            // Errores de validación
            // transforma el objeto cuenta en un string
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a new
            header('Location:' . URL . 'cuentas/edit/' . $id);

        } else {
            $this->model->update($id, $cuenta);

            $_SESSION['mensaje'] = "Cuenta editada correctamente";

            header('location:' . URL . 'cuentas');
        }
    }

    function show($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        // Obtengo la id de la cuenta que quiero mostrar
        $id = $param[0];

        // Obtengo los datos de la cuenta mediante el modelo
        $cuenta = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles de la cuenta";
        $this->view->cuenta = $cuenta;

        // Cargo la vista de detalles de la cuenta
        $this->view->render('cuentas/show/index');

    }


    function order($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        # Obtengo el criterio de ordenación
        $criterio = $param[0];

        # Creo la propiedad "title" de la vista
        $this->view->title = "Ordenar - Panel de Control cuentas";

        # Creo la propiedad cuentas dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get()
        $this->view->cuentas = $this->model->order($criterio);

        # Cargo la vista principal de cuentas
        $this->view->render('cuentas/main/index');

    }

    function filter($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión cuentas";

        //Creamos la variable cuentas dentro de la vista
        //Esta variable ejecuta el método get() del modelo cuentasModel
        $this->view->cuentas = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('cuentas/main/index');
    }

    function delete($param = [])
    {

        # Iniciamos la sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        // Obtengo la id de la cuenta que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id de la cuenta
        $this->model->delete($id);

        // Cargo de nuevo la vista cuentas actualizada
        header('location:' . URL . 'cuentas');
    }

    // Al descargar el archivo importado éste no se muestra hasta que se actualiza la carpeta (cerrar y abrir o
    // actualizar el escritorio.)
    function export()
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['export']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
        }

        $cuentas = $this->model->getCSV()->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cuentas.csv"');

        $ficheroExport = fopen('php://output', 'w');

        // Iterar sobre las cuentas y escribir los datos en el archivo CSV
        foreach ($cuentas as $cuenta) {

            $fecha = date("Y-m-d H:i:s");

            $cuenta['create_at'] = $fecha;
            $cuenta['update_at'] = $fecha;

            $cuenta = array(
                'num_cuenta' => $cuenta['num_cuenta'],
                'id_cliente' => $cuenta['id_cliente'],
                'fecha_alta' => $cuenta['fecha_alta'],
                'fecha_ul_mov' => $cuenta['fecha_ul_mov'],
                'num_movtos' => $cuenta['num_movtos'],
                'saldo' => $cuenta['saldo'],
                'create_at' => $cuenta['create_at'],
                'update_at' => $cuenta['update_at']
            );

            fputcsv($ficheroExport, $cuenta, ';');
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['import']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuentas');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo_csv"]) && $_FILES["archivo_csv"]["error"] == UPLOAD_ERR_OK) {
            $file = $_FILES["archivo_csv"]["tmp_name"];

            $handle = fopen($file, "r");

            if ($handle !== FALSE) {
                // Iterar sobre el archivo CSV y procesar cada línea
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Obtener los datos de cada fila y guardarlos en variables
                    $num_cuenta = $data[0];
                    $id_cliente = $data[1];
                    $fecha_alta = $data[2];
                    $fecha_ul_mov = $data[3];
                    $num_movtos = $data[4];
                    $saldo = $data[5];

                    // Verificar si ya existe una cuenta con el mismo numero de cuenta,
                    // ya que no se pueden repetir.
                    if (!$this->model->existeCuenta($num_cuenta)) {
                        // Si no existe, crear una nueva cuenta
                        $cuenta = new classCuenta();
                        $cuenta->num_cuenta = $num_cuenta;
                        $cuenta->id_cliente = $id_cliente;
                        $cuenta->fecha_alta = $fecha_alta;
                        $cuenta->fecha_ul_mov = $fecha_ul_mov;
                        $cuenta->num_movtos = $num_movtos;
                        $cuenta->saldo = $saldo;

                        // Insertar la cuenta en la base de datos
                        $this->model->create($cuenta);
                    } else {
                        // Si ya existe, se ignora la cuenta
                        echo "Ya existe una cuenta registrada con ese número. Se ha ignorado la cuenta.";
                    }
                }

                fclose($handle);
                $_SESSION['mensaje'] = "Importación completada correctamente";
                header('location:' . URL . 'cuentas');
                exit();

            } else {
                $_SESSION['error'] = "Error al abrir el archivo CSV";
                header('location:' . URL . 'cuentas');
                exit();

            }

        } else {
            $_SESSION['error'] = "No se ha seleccionado ningún archivo CSV";
            header('location:' . URL . 'cuentas');
            exit();
        }
    }

}

?>