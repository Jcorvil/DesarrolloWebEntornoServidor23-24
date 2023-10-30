<?php

    /*

        Modelo: model.mostrar.php
        Descripcion: muestra los detalles de un artículo sin edición

        Método GET:
                    - id del artículo que quiero editar

    */

    # cargamos los  datos
    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();
    $marcas = generar_tabla_marcas();

    # id del  artículo que quiero mostrar
    $id = $_GET['id'];

    # busco el  índice de la  tabla  correspondiente a ese  id
    $indice_mostrar = buscar_en_tabla($articulos, 'id', $id);

    // comparación estricta para distinguer el false del 0
    if ($indice_mostrar !== false) {
        // obtengo el array del libro a  editar
        $articulo = $articulos[$indice_mostrar];

    }  else { 
        echo 'ERROR: artículo  no encontrado';
        exit();
    }

?>