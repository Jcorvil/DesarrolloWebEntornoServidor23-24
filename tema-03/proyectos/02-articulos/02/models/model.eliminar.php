<?php

    /*

        Modelo: model.eliminar.php
        Descripcion: elimina un elemento de la  tabla

        Método GET:
                    - id del artículo que quiero eliminar

    */

    # cargamos la tabla
    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();


    # obtengo el  id del  artículo que deseo eliminar
    $id = $_GET['id'];

    # obtengo el índice  del artículo que deseo eliminar
    $indice_eliminar = buscar_en_tabla($articulos, 'id', $id);

    // comparación estricta para distinguer el false del 0
    if ($indice_eliminar !== false) {
        // elimino el libro seleccionado
        unset ($articulos[$indice_eliminar]);

        // reconstruyo el array 
        $articulos = array_values($articulos);

    }  else { 
        echo 'ERROR: artículo  no encontrado';
        exit();
    }

   

?>