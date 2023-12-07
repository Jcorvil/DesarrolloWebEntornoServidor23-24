<?php

    /*

        Modelo Principal index

    */

    # creamos objeto de la clase  curso
    $conexion = new Corredores();

    # Extraigo los datos de las categorias y clubs
    $categorias = $conexion -> getCategorias();

    $clubs = $conexion -> getClubs();

?>