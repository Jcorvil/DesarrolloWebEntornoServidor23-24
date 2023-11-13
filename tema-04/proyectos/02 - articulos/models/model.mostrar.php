<?php

    /*

        Modelo: model.mostrar.php
        Descripcion: muestra los detalles de un artículo sin edición

        Método GET:
                    - id del artículo que quiero editar

    */

    # cargamos los  datos
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();

    $articulos = new ArrayArticulos();
    $articulos->getDatos();


    # obtener  el id  del artículo que quiero mostrar
    $indice = $_GET['id'];

    
    $articulo = $articulos->read($indice);

?>