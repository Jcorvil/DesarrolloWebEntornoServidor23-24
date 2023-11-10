<?php

    /*

        Modelo: model.nuevo.php
        Descripcion: carga array categorias y array de marcas

    */

    # cargamos la tabla
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();


?>