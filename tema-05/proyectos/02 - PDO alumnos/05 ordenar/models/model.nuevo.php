<?php

    /*

        Modelo Nuevo

    */

    # creamos objeto de la clase  curso
    $conexion = new Alumnos();

    # Extraigo los datos de los alumnos
    $cursos = $conexion -> getCursos();

?>