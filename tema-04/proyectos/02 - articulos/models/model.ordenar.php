<?php

    /*

        Modelo: model.ordenar.php
        Descripcion: muestra los artículos  a partir de un  criterio de ordenación

        Método GET:
                    - critero: descripcion, modelo,  categoria, unidades, precio
    */

    # cargamos los datos
    $categorias = generar_tabla_categorias();
    $articulos = generar_tabla();

    # Cargo el criterio de ordenación
    $criterio = $_GET['criterio'];

    // Validar  criterio
    if (!in_array($criterio, array_keys($articulos[0]))) {
        echo "ERROR:  Criterio de  ordenación inxistente";
        exit();
    }

    # Ordenar tabla articulos
    $articulos = ordenar($articulos, $criterio);

?>