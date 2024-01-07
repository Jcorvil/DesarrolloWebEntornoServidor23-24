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

        # obtengo el id de la cuenta que voy a editar
        // cuenta/edit/4

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Editar - Panel de control cuentas";

        # obtener objeto de la clase cuenta
        $this->view->cuentas = $this->model->read($id);

        # cargo la vista
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