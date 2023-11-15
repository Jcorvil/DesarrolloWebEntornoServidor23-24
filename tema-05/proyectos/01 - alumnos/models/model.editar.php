<?php

    /*

        Modelo: model.editar.php
        Descripcion: edita los detalles de un articulo

        Método GET:
                    - id del libro que quiero editar

    */

    // Cargamos los datos
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();

    $articulos = new ArrayArticulos();
    $articulos->getDatos();


    # obtener  el id  del artículo que quiero  editar
    $indice = $_GET['id'];

    
    $articulo = $articulos->read($indice);

?>