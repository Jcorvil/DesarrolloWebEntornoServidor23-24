<?php

/*
    Modelo: model.eliminar.php
    Descripción: elimina un elemento de la tabla

    Método GET: -id del articulo que quiero eliminar
*/

#Cargo la tabla
$categorias = generar_tabla_categorias();
$articulos = generar_tabla();

$id = $_GET['id'];

$indice_eliminar = buscar_en_tabla($articulos, 'id', $id);

if ($indice_eliminar !== false) {

    unset($articulos[$indice_eliminar]);

    $articulos = array_values($articulos);

} else {
    echo 'ERROR: Libro no encontrado';
    exit();
}


?>