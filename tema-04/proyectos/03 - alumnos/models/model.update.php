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



$marcas = ArrayArticulos::getMarcas();
$categorias = ArrayArticulos::getCategorias();

$articulos = new ArrayArticulos();
$articulos->getDatos();

// Extraer índice del artículo que voy a editar
$indice = $_GET['indice'];

$articulo = $articulos->read($indice);

// Extraer los detalles del formulario
$edit_articulo = [

    'descripcion' => $_POST['descripcion'],
    'modelo' => $_POST['modelo'],
    'marca' => $_POST['marca'],
    'categorias' => $_POST['categorias'],
    'unidades' => $_POST['unidades'],
    'precio' => $_POST['precio']

];


$descripcion = $edit_articulo['descripcion'];
$modelo = $edit_articulo['modelo'];
$marca = $edit_articulo['marca'];
$categoriasArticulo = $edit_articulo['categorias'];
$unidades = $edit_articulo['unidades'];
$precio = $edit_articulo['precio'];


$articulo->setDescripcion($descripcion);
$articulo->setModelo($modelo);
$articulo->setMarca($marca);
$articulo->setCategoria($categoriasArticulo);
$articulo->setUnidades($unidades);
$articulo->setPrecio($precio);


// $articulos = update($articulos, $edit_articulo, $indice);

$articulos->update($indice, $articulo);


$notificacion = "Articulo editado";

?>