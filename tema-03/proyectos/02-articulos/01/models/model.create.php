<?php

$articulos = generar_tabla();
$categorias = generar_tabla_categorias();

$new_articulo = [

    'id' => siguienteID($articulos),
    'descripcion' => $_POST['descripcion'],
    'modelo' => $_POST['modelo'],
    'categoria' => $_POST['categoria'],
    'unidades' => $_POST['unidades'],
    'precio' => $_POST['precio']
];

//$articulos[] = $new_articulo;

$articulos = nuevo($articulos, $new_articulo);

?>