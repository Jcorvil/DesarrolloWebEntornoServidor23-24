<?php
require_once 'class/class.cuenta.php';
require_once 'models/clientesModel.php';


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

    function new()
    {

        # Iniciar o continuar sesión
        session_start();

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión cuentas";

        $clienteModel = new clientesModel();
        $clientesDisponibles = $clienteModel->get();


        $listaClientes = [];
        foreach ($clientesDisponibles as $cliente) {
            $nombreCompleto = $cliente->cliente . ', ';
            $listaClientes[$cliente->id] = $nombreCompleto;
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


        $this->view->clientes = $listaClientes;

        # cargo la vista con el formulario nuevo cliente
        $this->view->render('cuentas/new/index');
    }

    function create($param = [])
    {

        # Iniciar sesión
        session_start();


        # 1. Seguridad. Saneamos los datos del formulario
        $num_cuenta = filter_input(INPUT_POST, 'num_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_input(INPUT_POST, 'fecha_alta', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_ul_mov = filter_input(INPUT_POST, 'fecha_ul_mov', FILTER_SANITIZE_SPECIAL_CHARS);
        $num_movtos = filter_input(INPUT_POST, 'num_movtos', FILTER_SANITIZE_NUMBER_INT);
        $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_NUMBER_INT);


        # 2. Creamos la cuenta con los datos saneados
        # Cargamos los datos del formulario
        $cuenta = new classCuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            $fecha_ul_mov,
            $num_movtos,
            $saldo
        );

        # Validación
        $errores = [];

        // num_cuenta
        if (empty($num_cuenta)) {
            $errores['num_cuenta'] = 'El Nº de la cuenta es obligatorio';
        } else {
            // Verificar si el número de cuenta ya existe
            if ($this->model->existeCuenta($num_cuenta)) {
                $errores['num_cuenta'] = 'El Nº de la cuenta ya existe';
            }
        }

        // id_cliente
        if (empty($id_cliente)) {
            $errores['id_cliente'] = 'El campo cliente es obligatorio';
        } else if (!filter_var($id_cliente, FILTER_VALIDATE_INT)) {
            $errores['id_cliente'] = 'Cliente no válido';
        }

        // fecha_alta
        if (empty($fecha_alta)) {
            $errores['fecha_alta'] = 'Debe introducir una fecha de alta';
        }

        // // fecha_ul_mov
        // if (empty($fecha_ul_mov)) {
        //     $errores['fecha_ul_mov'] = 'Debe introducir una fecha';
        // }

        // num_movtos
        if (empty($num_movtos)) {
            $errores['num_movtos'] = 'La cuenta debe tener al menos un movimiento';
        }

        // saldo
        if (empty($saldo)) {
            $errores['saldo'] = 'La cuenta debe tener al menos un movimiento';
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
        }

        # Añadir registro a la tabla
        $this->model->create($cuenta);

        # Mensaje
        $_SESSION['mensaje'] = "Cuenta creada correctamente";

        # Redirigimos al main de cuentas
        header('location:' . URL . 'cuentas');
    }


    function edit($param = [])
    {

        # Iniciamos la sesión
        session_start();

        # Obtengo el valor del ID de la cuenta a editar
        $id = $param[0];

        # Creo una variable id en view y la igualo al valor del primer parámetro pasado
        $this->view->id = $id;

        $this->view->title = "Editar - Gestión Cuenta";

        # Obtener objeto de la clase cuenta
        $this->view->cuenta = $this->model->read($id);
        # Obtener los cliente
        $this->view->clientes = $this->model->getClienteCuenta();

        # Comprobar si el formulario viene de una no validación
        if (!empty($errores)) {
            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorrellenar el formulario con los detalles del alumno
            $this->view->cuenta = unserialize($_SESSION['cuenta']);

            # Recupero array de errores específicos
            $this->view->errores = $_SESSION['errores'];

            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cuenta']);

        }

        # Obtener datos de los clientes disponibles desde el modelo de clientes
        $clienteModel = new clientesModel();
        $clientesDisponibles = $clienteModel->get();

        $clientesConcatenados = [];
        foreach ($clientesDisponibles as $cliente) {
            $nombreCompleto = $cliente->cliente;
            $clientesConcatenados[$cliente->id] = $nombreCompleto;
        }

        // Ordenamos el array
        asort($clientesConcatenados);

        $this->view->clientes = $clientesConcatenados;

        $this->view->render('cuentas/edit/index');
    }

    function update($param = [])
    {

        # Iniciamos la sesión
        session_start();

        # 1. Seguridad. Saneamos los datos del formulario
        $num_cuenta = filter_input(INPUT_POST, 'num_cuenta', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_input(INPUT_POST, 'fecha_alta', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_ul_mov = filter_input(INPUT_POST, 'fecha_ul_mov', FILTER_SANITIZE_SPECIAL_CHARS);
        $num_movtos = filter_input(INPUT_POST, 'num_movtos', FILTER_SANITIZE_NUMBER_INT);
        $saldo = filter_input(INPUT_POST, 'saldo', FILTER_SANITIZE_NUMBER_INT);

        # 2. Creamos la cuenta con los datos saneados
        # Cargamos los datos del formulario
        $cuenta = new classCuenta(
            null,
            $num_cuenta,
            $id_cliente,
            $fecha_alta,
            $num_movtos,
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
            $_POST['id_cliente'],
            $_POST['fecha_alta'],
            $_POST['fecha_ul_mov'],
            $_POST['num_movtos'],
            $_POST['saldo']
        );



        # 3. Validacion
        $errores = [];

        // num_cuenta
        if (strcmp($cuenta->num_cuenta, $cuentaOG->num_cuenta) !== 0) {
            if (empty($num_cuenta)) {
                $errores['num_cuenta'] = 'El Nº de la cuenta es obligatorio';
            }
        }

        // id_cliente
        if (strcmp($cuenta->id_cliente, $cuentaOG->id_cliente) !== 0) {
            if (empty($id_cliente)) {
                $errores['id_cliente'] = 'El campo cliente es obligatorio';
            } else if (!filter_var($id_cliente, FILTER_VALIDATE_INT)) {
                $errores['id_cliente'] = 'Cliente no válido';
            }
        }

        // fecha_alta
        if (empty($fecha_alta)) {
            $errores['fecha_alta'] = 'Debe introducir una fecha de alta';
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
        if (strcmp($cuenta->num_movtos, $cuentaOG->num_movtos) !== 0) {
            if (empty($num_movtos)) {
                $errores['num_movtos'] = 'La cuenta debe tener al menos un movimiento';
            }
        }

        // saldo
        if (strcmp($cuenta->saldo, $cuentaOG->saldo) !== 0) {
            if (empty($saldo)) {
                $errores['saldo'] = 'La cuenta debe tener saldo';
            }
        }

        # 4. Comprobar validación

        if (!empty($errores)) {
            // Errores de validación
            // transforma el objeto cuenta en un string
            $_SESSION['cuenta'] = serialize($cuenta);
            $_SESSION['error'] = 'Formulario no validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a new
            header('Location:' . URL . 'cuenta/edit/' . $id);

        } else {
            $this->model->update($id, $cuenta);

            $_SESSION['mensaje'] = "Cuenta editado correctamente";

            header('location:' . URL . 'cuentas');
        }
    }

    function show($param = [])
    {

        session_start();

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

        session_start();

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

        session_start();

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

        session_start();

        // Obtengo la id de la cuenta que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id de la cuenta
        $this->model->delete($id);

        // Cargo de nuevo la vista cuentas actualizada
        header('location:' . URL . 'cuentas');
    }


}

?>