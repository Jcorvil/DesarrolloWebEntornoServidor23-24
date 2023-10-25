<?php

$articulos = generar_tabla();
$categorias = generar_tabla_categorias();

$new_articulo = [

    'id' => $_POST['id'],
    'descripcion' => $_POST['descripcion'],
    'modelo' => $_POST['modelo'],
    'categoria' => $_POST['categoria'],
    'unidades' => $_POST['unidades'],
    'precio' => $_POST['precio']
];

//$articulos[] = $new_articulo;

nuevo($articulos, $articulo);

?>