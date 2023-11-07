<?php

    /*

        Modelo: model.update.php
        Descripcion: actualiza los detalles de un  artículo

        Método POST:
                    - descripcion
                    - modelo
                    - genero
                    - unidades
                    - precio

        Método GET:
                    - indice -> índice  del articulo que quiero editar

    */

    $articulos = generar_tabla();
    $marcas = generar_tabla_marcas();
    $categorias = generar_tabla_categorias();

    // Extraer índice del artículo que voy a editar
    $indice = $_GET['indice'];

    // Extraer los detalles del formulario
    $edit_articulo = [

        'id' => $_POST['id'],
        'descripcion'=>$_POST['descripcion'],
        'modelo'=>$_POST['modelo'],
        'marca'=>$_POST['marca'] ,
        'categorias'=>$_POST['categorias'],
        'unidades'=> $_POST['unidades'],
        'precio'=> $_POST['precio']

    ];

    // $articulos = update($articulos, $edit_articulo, $indice);

    $articulos[$indice] = $edit_articulo;

?>