<?php

/*
    Modelo: model.mostrar.php
    Descripción: muestra los detalles un libro existente

    Método GET: -id del libro que quiero mostrar
*/

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($libros, 'id', $id);

if ($indice_mostrar !== false) {

    $libro = $libros[$indice_mostrar];

    

} else {
    echo 'ERROR: Libro no encontrado';
    exit();
}


?>