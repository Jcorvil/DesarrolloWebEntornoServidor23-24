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

        # Creo la propiedad title de la vista
        $this->view->title = "Tabla de cuentas";

        # Creo la propiedad cuentas dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get();
        $this->view->cuentas = $this->model->get();

        $this->view->render('cuentas/main/index');
    }

    function new()
    {

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión cuentas";

        $clienteModel = new clientesModel();
        $clientesDisponibles = $clienteModel->get();

        $listaClientes = [];
        foreach ($clientesDisponibles as $cliente) {
            $nombreCompleto = $cliente->cliente . ', ';
            $listaClientes[$cliente->id] = $nombreCompleto;
        }
        

        $this->view->clientes = $listaClientes;

        # cargo la vista con el formulario nuevo cliente
        $this->view->render('cuentas/new/index');
    }

    function create($param = [])
    {

        # Cargamos los datos del formulario
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $_POST['id_cliente'],
            $_POST['fecha_alta'],
            $_POST['fecha_ul_mov'],
            $_POST['num_movtos'],
            $_POST['saldo'],
        );



        # Validación

        # Añadir registro a la tabla
        $this->model->create($cuenta);

        # Redirigimos al main de cuentas
        header('location:' . URL . 'cuentas');
    }

    function edit($param = [])
    {
        # Obtengo el valor del ID de la cuenta a editar
        $id = $param[0];

        # Creo una variable id en view y la igualo al valor del primer parámetro pasado
        $this->view->id = $id;

        $this->view->title = "Editar - Gestión Cuenta";

        # Obtener objeto de la clase cuenta
        $this->view->cuenta = $this->model->read($id);
        $this->view->clientes = $this->model->getClienteCuenta();

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
        # Cargo id de la cuenta
        $id = $param[0];

        # Con los detalles del formulario creo objeto cuenta
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $_POST['id_cliente'],
            $_POST['fecha_alta'],
            $_POST['fecha_ul_mov'],
            $_POST['num_movtos'],
            $_POST['saldo'],
        );

        $this->model->update($id, $cuenta);

        header('location:' . URL . 'cuentas');

    }

    function show($param = [])
    {
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
        // Obtengo la id de la cuenta que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id de la cuenta
        $this->model->delete($id);

        // Cargo de nuevo la vista cuentas actualizada
        header('location:' . URL . 'cuentas');
    }


}

?>