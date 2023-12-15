<?php

class Alumno extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {
        $this->view->nombre = 'Jorge';
        $this->view->apellidos = 'Coronil Villalba';

        $this->view->render('alumno/main/index');
    }
    function new()
    {
        $this->view->render('alumno/new/index');
    }

    function show($param = []) {

    }
}


?>