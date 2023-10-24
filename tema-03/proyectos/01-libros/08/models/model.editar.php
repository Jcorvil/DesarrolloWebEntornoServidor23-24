<?php

/*
    Modelo: model.editar.php
    Descripción: edita los detalles un libro existente

    Método GET: -id del libro que quiero editar
*/

#Cargo la tabla
$libros = generar_tabla();

$id = $_GET['id'];

$indice_editar = buscar_en_tabla($libros, 'id', $id);

if ($indice_editar !== false) {

    $libro = $libros[$indice_editar];

    

} else {
    echo 'ERROR: Libro no encontrado';
    exit();
}


?>