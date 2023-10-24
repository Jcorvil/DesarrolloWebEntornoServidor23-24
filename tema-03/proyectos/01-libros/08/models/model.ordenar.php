<?php

/*
    Modelo: model.ordenar.php
    Descripción: muestra los libros a prtir de un criterio

    Método GET: -criterio: titulo, autor, genero, precio
*/


#Cargo la tabla
$libros = generar_tabla();


#Cargo el criterio de ordenación
$criterio = $_GET['criterio'];


#Ordenar tabla libros

//Cargo en un array todos los valores del criterio de ordenación
$aux = array_column($libros, $criterio);

//Validar criterio
if (!in_array($criterio, array_keys($libros[0]))) {
    echo "ERROR: Criterio de ordenación inexistente";
    exit();

}

//Función array_multisort
array_multisort($aux, SORT_ASC, $libros);


?>