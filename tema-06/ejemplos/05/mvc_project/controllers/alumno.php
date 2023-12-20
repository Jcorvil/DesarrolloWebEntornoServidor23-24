<?php

class Alumno extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # Creo la propiedad title en la vista
        $this->view->title = "Home - Panel de control Alumnos";

        # Creo la propiedad alumnos dentro de la vista
        # del modelo asignado al controlador ejecuto el método get(); 
        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');
    }
    function new()
    {

        # Etiqueta title de la vista
        $this->view->title = "Añadir - Gestión de alumnos";

        # Obtener los cursos para generar dinámicamente lista cursos
        $this->view->cursos = $this->model->getCursos();

        # Cargo la vita con el formulario nuevo alumno
        $this->view->render('alumno/new/index');
    }

    function show($param = [])
    {

    }

    function create($param = [])
    {

        # Cargamos los datos del formulario
        $alumno = new classAlumno(
            null,
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['email'],
            $_POST['telefono'],
            null,
            $_POST['poblacion'],
            null,
            null,
            $_POST['dni'],
            $_POST['fechaNac'],
            $_POST['id_curso']
        );

        # Validación

        # Añadir registro a la tabla
        $this->model->create($alumno);

        # Redirigimos al main de alumnos
        header('location:' . URL . 'alumno');

    }

    function edit($param = [])
    {
        # Obtengo el id del alumno que voy a editar

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $param[0];

        # title
        $this->view->title = "Edit - Panel de control Alumnos";

        # Obtener el objeto de la clase alumno
        $this->view->alumno = $this->model->read($id);
        $this->view->alumno = $this->model->getCursos($id);

        $this->view->render('alumnos/edit/index');
    }

}


?>