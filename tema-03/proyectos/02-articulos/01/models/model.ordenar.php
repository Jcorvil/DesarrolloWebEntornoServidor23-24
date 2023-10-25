<?php


/*
    Modelo: model.ordenar.php
    Descripción: muestra los articulos a partir de un criterio

    Método GET: -criterio: descripcion, modelo, categoria, unidades, precio
*/

$categorias = generar_tabla_categorias();

#Cargo la tabla
$articulos = generar_tabla();


#Cargo el criterio de ordenación
$criterio = $_GET['criterio'];


#Ordenar tabla libros

//Cargo en un array todos los valores del criterio de ordenación
$aux = array_column($articulos, $criterio);

//Validar criterio
if (!in_array($criterio, array_keys($articulos[0]))) {
    echo "ERROR: Criterio de ordenación inexistente";
    exit();

}

//Función array_multisort
array_multisort($aux, SORT_ASC, $articulos);


?>