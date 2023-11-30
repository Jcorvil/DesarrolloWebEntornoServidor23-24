<?php

    /*

        Modelo Principal index

    */

    # creamos objeto de la clase  curso
    $conexion = new Alumnos();

    # Extraigo los datos de los alumnos
    $alumnos = $conexion -> getAlumnos();

?>