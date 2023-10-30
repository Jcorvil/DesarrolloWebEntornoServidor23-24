<?php

    /*

        Modelo: model.editar.php
        Descripcion: edita los detalles de un articulo

        Método GET:
                    - id del libro que quiero editar

    */

    // Cargamos los datos
    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();
    $marcas = generar_tabla_marcas();

    // ordenamos las categorias
    asort($categorias);


    # obtener  el id  del artículo que quiero  editar
    $id_editar = $_GET['id'];

    # obtener el índice  del  libro
    $indice_editar = buscar_en_tabla($articulos, 'id', $id_editar);

    // comparación estricta para distinguir el false del 0
    if ($indice_editar !== false) {
        // obtengo el array del artículo a  editar
        $articulo = $articulos[$indice_editar];

    }  else { 
        echo 'ERROR: artículo  no encontrado';
        exit();
    }
?>