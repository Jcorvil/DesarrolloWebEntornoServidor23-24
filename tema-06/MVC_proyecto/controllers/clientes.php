<?php
require_once 'class/class.cliente.php';

class Clientes extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # Creo la propiedad title de la vista
        $this->view->title = "Tabla de clientes";

        # Creo la propiedad clientes dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get();
        $this->view->clientes = $this->model->get();

        $this->view->render('clientes/main/index');
    }

    function new()
    {

        # etiqueta title de la vista
        $this->view->title = "Añadir - Gestión clientes";

        # cargo la vista con el formulario nuevo cliente
        $this->view->render('clientes/new/index');
    }

    function create($param = [])
    {

        # Cargamos los datos del formulario
        $cliente = new classCliente(
            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
        );

        # Validación

        # Añadir registro a la tabla
        $this->model->create($cliente);

        # Redirigimos al main de clientes
        header('location:' . URL . 'clientes');
    }

    function edit($param = [])
    {

        # obtengo el id del cliente que voy a editar
        // cliente/edit/4

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Editar - Panel de control Clientes";

        # obtener objeto de la clase cliente
        $this->view->cliente = $this->model->read($id);

        # cargo la vista
        $this->view->render('clientes/edit/index');

    }

    function update($param = [])
    {
        # Cargo id del cliente
        $id = $param[0];

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
        // Obtengo la id del cliente que quiero eliminar
        $id = $param[0];

        // Llamo al método "delete" y le envío la id del cliente
        $this->model->delete($id);

        // Cargo de nuevo la vista clientes actualizada
        header('location:' . URL . 'clientes');
    }


}

?>