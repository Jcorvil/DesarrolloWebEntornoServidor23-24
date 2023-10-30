<?php

    /*

        Modelo: model.create.php
        Descripcion: añade un nuevo  artículo en a la tabla

        Método POST:
                    - descripcion
                    - modelo
                    - genero
                    - unidades
                    - precio

    */

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();
    $marcas = generar_tabla_marcas();

    $new_articulo = [

        'id' => generar_id($articulos),
        'descripcion'=>$_POST['descripcion'],
        'modelo'=>$_POST['modelo'],
        'marca'=>$_POST['marca'],
        'categorias'=>$_POST['categorias'], // array de  categorias
        'unidades'=> $_POST['unidades'],
        'precio'=> $_POST['precio']

    ];

    // $articulos = nuevo($articulos, $new_articulo);

    $articulos[] = $new_articulo;

?>