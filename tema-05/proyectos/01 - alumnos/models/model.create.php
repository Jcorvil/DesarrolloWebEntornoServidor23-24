<?php

    /*

        Modelo: model.create.php
        Descripcion: añade un nuevo  artículo en a la tabla

        Método POST:
                    - id
                    - descripcion
                    - modelo
                    - genero
                    - marca - indice
                    - unidades
                    - precio
                    - categoria - array

    */

    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();


    $articulos = new ArrayArticulos();
    $articulos->getDatos();


    #Cargo en variables los detalles del artículo
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $categorias_art = $_POST['categorias'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];
    

    #Creo un objeto clase artículo a partir de los detalles del formulario
    $articulo = new Articulo(
        $id,
        $descripcion,
        $modelo,
        $marca,
        $categorias_art,
        $unidades,
        $precio
    );

    
    #Añado el artículo al array de artículos
    $articulos->create($articulo);

    #Genero notificación
    $notificacion = "Artículo creado con éxtio";

?>