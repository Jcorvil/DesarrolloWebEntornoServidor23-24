<?php

    /*

        Modelo: model.nuevo.php
        Descripcion: carga array cursos y array de asignaturas

    */

    setlocale(LC_MONETARY, "es_ES"); 

    # cargamos la tabla
    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();


?>