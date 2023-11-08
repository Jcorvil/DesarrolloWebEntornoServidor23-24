<?php

    /*

        Modelo: model.nuevo.php
        Descripcion: carga array categorias generar el select dinámico de categorías

    */

    # cargamos la tabla
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();


?>