<?php

/*
    Modelo: model.editar.php
    Descripción: edita los detalles un artículo existente

    Método GET: -id del artículo que quiero editar
*/

$categorias = generar_tabla_categorias();

#Cargo la tabla
$articulos = generar_tabla();

$id = $_GET['id'];

$indice_editar = buscar_en_tabla($articulos, 'id', $id);

if ($indice_editar !== false) {

    $articulo = $articulos[$indice_editar];

    

} else {
    echo 'ERROR: Artículo no encontrado';
    exit();
}

?>