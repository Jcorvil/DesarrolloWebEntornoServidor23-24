<?php

    /*

        Modelo: model.index.php
        Descripcion: genera un array los de objetos de artículos

    */

    #Cargamos los arrays a partir de los métodos estáticos de la clase
    #ArrayAlumnos
    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();

    #Creamos un objeto de la clase ArrayAlumnos
    $alumnos = new ArrayAlumnos();

    $alumnos->getAlumnos();

?>