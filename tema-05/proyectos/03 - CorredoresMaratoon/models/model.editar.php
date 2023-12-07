<?php

    /*

        Modelo Principal index

    */

    $id = $_GET['$id'];

    # creamos objeto de la clase  curso
    $conexion = new Corredores();

    # Extraigo los datos de las categorias y clubs
    $categorias = $conexion -> getCategorias();

    $clubs = $conexion -> getClubs();

    $corredor = $conexion -> read($$id);

?>