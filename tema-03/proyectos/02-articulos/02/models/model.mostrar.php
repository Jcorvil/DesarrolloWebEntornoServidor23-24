<?php

/*
    Modelo: model.mostrar.php
    Descripción: muestra los detalles un artículo existente

    Método GET: -id del artículo que quiero mostrar
*/

#Cargo la tabla
$articulos = generar_tabla();

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($articulos, 'id', $id);

if ($indice_mostrar !== false) {

    $articulo = $articulos[$indice_mostrar];

    

} else {
    echo 'ERROR: Artículo no encontrado';
    exit();
}


?>