<?php

/*
    Modelo: model.eliminar.php
    Descripción: elimina un elemento de la tabla

    Método GET: -id del libro que quiero eliminar
*/

#Cargo la tabla
$libros = generar_tabla();

$id = $_GET['id'];

$indice_eliminar = buscar_en_tabla($libros, 'id', $id);

if ($indice_eliminar !== false) {

    //Elimino el libro seleccionado 
    unset($libros[$indice_eliminar]);

    //Reconstruyo el array
    $libros = array_values($libros);
} else {
    echo 'ERROR: Libro no encontrado';
    exit();
}


?>