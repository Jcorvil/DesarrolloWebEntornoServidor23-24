<?php

    /*

        Modelo Principal index

    */

    # creamos objeto de la clase  curso
    $conexion = new Corredores();

    # Extraigo los datos de los corredores
    $corredores = $conexion -> getCorredores();

?>