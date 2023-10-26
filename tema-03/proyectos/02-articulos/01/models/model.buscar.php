<?php

/*
    Modelo: model.buscar.php
    Descripción: filtra los libros a partir de la expresión de búsqueda

    Método GET: -expresión: prompt o expresión de búsqueda
*/


$articulos = generar_tabla();
$categorias = generar_tabla_categorias();


$expresion = $_GET['expresion'];

$aux = [];
foreach ($articulos as $articulo) {
    if ( false !== array_search($expresion, $articulo, false)) {
        $aux[] = $articulo;
    }

}

if (!empty($aux)) {
    $articulos = $aux;
}


?>