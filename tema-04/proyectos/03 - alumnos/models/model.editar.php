<?php

    /*

        Modelo: model.editar.php
        Descripcion: edita los detalles de un alumno

        Método GET:
                    - id del alumno que quiero editar

    */

    // Cargamos los datos
    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();

    $alumnos = new ArrayAlumnos();
    $alumnos->getAlumnos();


    # obtener  el id  del alumno que quiero  editar
    $indice = $_GET['id'];

    
    $alumno = $alumnos->getAlumnos()[$indice];

?>