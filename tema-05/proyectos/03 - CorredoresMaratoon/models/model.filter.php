<?php

    /*

        Modelo Principal index

    */

    $expresion = $_GET['expresion'];

    # creamos objeto de la clase  curso
    $conexion = new Corredores();

    $corredores = $conexion-> filter($expresion);

?>