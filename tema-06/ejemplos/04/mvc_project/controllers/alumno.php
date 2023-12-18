<?php

class Alumno extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        # Creo la propiedad alumnos dentro de la vista
        # del modelo asignado al controlador ejecuto el método get(); 
        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');
    }
    function new()
    {

        # Etiqueta title de la vista
        $this->view->title ="Añadir - Gestión de alumnos";

        # Obtener los cursos para generar dinámicamente lista cursos
        $this->model->getCursos();

        # Cargo la vita con el formulario nuevo alumno
        $this->view->render('alumno/new/index');
    }

    function show($param = []) {

    }
}


?>