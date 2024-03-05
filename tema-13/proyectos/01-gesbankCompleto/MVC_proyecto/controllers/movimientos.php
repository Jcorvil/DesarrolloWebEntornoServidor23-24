<?php

class Movimientos extends Controller
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        } else {

            # Comprobar si existe el mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            # Creo la propiedad title de la vista
            $this->view->title = "Tabla movimientos";

            # Creo la propiedad movimientos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->movimientos = $this->model->get();
            $this->view->render("movimientos/main/index");
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
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        }

        # obtener objeto de la clase movimiento
        $this->view->movimiento = $this->model->read();

        # Comprobar si vuelvo de un registro no validado
        if (isset($_SESSION['error'])) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles de la movimiento
            $this->view->movimiento = unserialize($_SESSION['movimiento']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['movimiento']);
        }

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión movimientos";

        # cargo la vista con el formulario nuevo movimiento
        $this->view->render('movimientos/new/index');
    }


    function create($param = [])
    {
        // Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        }

        // 1. Seguridad. Saneamos los datos del formulario
        $id_cuenta = filter_input(INPUT_POST, 'id_cuenta', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_hora = filter_input(INPUT_POST, 'fecha_hora', FILTER_SANITIZE_SPECIAL_CHARS);
        $concepto = filter_input(INPUT_POST, 'concepto', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);
        $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        # Cargamos los datos del formulario
        $movimiento = new classMovimiento(
            null,
            $id_cuenta,
            $fecha_hora,
            $concepto,
            $tipo,
            $cantidad,
            $saldo
        );

        // Validación
        $errores = [];

        // id_cuenta
        if (empty($id_cuenta)) {
            $errores['id_cuenta'] = 'Cuenta del movimiento obligatorio';
        }

        // fecha_hora
        // if (empty($fecha_hora)) {
        //     $errores['fecha_hora'] = 'fecha_hora del movimiento obligatorio';
        // } 

        // concepto
        if (empty($concepto)) {
            $errores['concepto'] = 'concepto obligatorio';
        } elseif (strlen($concepto) > 50) {
            $errores['concepto'] = 'El concepto no puede tener mas de 50 caracteres';
        }

        // Tipo
        if (empty($tipo)) {
            $errores['tipo'] = 'Tipo obligatorio';
        } elseif (!in_array($tipo, ['I', 'R'])) {
            $errores['tipo'] = 'El tipo debe ser I (ingreso) o bien R (reintegro)';
        }

        // cantidad
        if (!is_numeric($cantidad)) {
            $errores['cantidad'] = 'La cantidad debe ser un valor numérico';
        } elseif ($tipo == 'R' && $cantidad > $saldo) {
            $errores['cantidad'] = 'La cantidad no puede superar el saldo de la cuenta';
        } elseif ($tipo == 'R') {
            $cantidad *= -1; // Convertir a negativo para representar un reintegro
        }

        // Saldo

        // Comprobar validación
        if (!empty($errores)) {
            // Errores de validación
            // Transforma el objeto movimiento en un string
            $_SESSION['movimiento'] = serialize($movimiento);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            // Redireccionamos a new
            header('Location:' . URL . 'movimientos/new');
            exit();
        } else {
            // Actualizar el saldo de cuentas
            $this->actualizarSaldoCuenta($id_cuenta, $cantidad);

            $this->model->create($movimiento);

            $_SESSION['mensaje'] = 'Movimiento creado correctamente';

            header('location:' . URL . 'movimientos');
        }
    }

    // Función para actualizar el saldo de la cuenta
    private function actualizarSaldoCuenta($id_cuenta, $cantidad)
    {
        // Obtener el saldo actual de la cuenta
        $saldo_actual = $this->model->getSaldoCuenta($id_cuenta);

        // Actualizar el saldo sumando o restando la cantidad del movimiento
        $nuevo_saldo = $saldo_actual + $cantidad;

        // Actualizar el saldo en la base de datos
        $this->model->updateSaldoCuenta($id_cuenta, $nuevo_saldo);
    }



    function show($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['show']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        }

        // Obtengo la id del movimiento que quiero mostrar
        $id = $param[0];

        // Obtengo los datos del movimiento mediante el modelo
        $movimiento = $this->model->read($id);

        // Configuro las propiedades de la vista
        $this->view->title = "Detalles del movimiento";
        $this->view->movimiento = $movimiento;

        // Cargo la vista de detalles del movimiento
        $this->view->render('movimientos/show/index');

    }


    function filter($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        }

        //Obtengo la expresión de filtrado
        $expresion = $_GET['expresion'];

        //Cambio la propiedad title de la vista
        $this->view->title = "Buscar - Gestión movimientos";

        //Creamos la variable movimientos dentro de la vista
        //Esta variable ejecuta el método get() del modelo movimientosModel
        $this->view->movimientos = $this->model->filter($expresion);

        //Cargo la vista index
        $this->view->render('movimientos/main/index');
    }


    function order($param = [])
    {

        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario no autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'movimientos');
        }

        # Obtengo el criterio de ordenación
        $criterio = $param[0];

        # Creo la propiedad "title" de la vista
        $this->view->title = "Ordenar - Panel de Control movimientos";

        # Creo la propiedad movimientos dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get()
        $this->view->movimientos = $this->model->order($criterio);

        # Cargo la vista principal de movimientos
        $this->view->render('movimientos/main/index');

    }


}

?>