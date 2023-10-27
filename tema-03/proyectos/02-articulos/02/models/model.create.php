<?php

$articulos = generar_tabla();
$categorias = generar_tabla_categorias();
$marcas = generar_tabla_marcas();

$new_articulo = [

    'id' => ultimoID($articulos),
    'descripcion' => $_POST['descripcion'],
    'modelo' => $_POST['modelo'],
    'marca' => $_POST['marca'],
    'categoria' => $_POST['categoria'],
    'unidades' => $_POST['unidades'],
    'precio' => $_POST['precio']
];

//$articulos[] = $new_articulo;

$articulos = nuevo($articulos, $new_articulo);

?>