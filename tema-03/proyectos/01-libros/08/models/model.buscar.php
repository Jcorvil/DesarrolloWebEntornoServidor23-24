<?php

/*
    Modelo: model.buscar.php
    Descripción: filtra los libros a partir de la expresión de búsqueda

    Método GET: -expresión: pormpt o expresión de búsqueda
*/


#Cargo la tabla
$libros = generar_tabla();

#Cargo el criterio de ordenación
$expresion = $_GET['expresion'];


#Filtra la tabla libros a partir de la expresión

//Creo un array vacío que cargue los libros que cumplan la expresión de búsqueda
$aux = [];
foreach ($libros as $libro) {
    if (array_search($expresion, $libro, false)) {
        $aux[] = $libro;
    }

}

#Validar búsqueda
if (!empty($aux)) {
    $libros = $aux;
}




?>