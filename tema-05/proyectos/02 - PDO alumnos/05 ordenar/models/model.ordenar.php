<?php

/*
    Modelo ordenar
*/

# Creamos objeto de la clase Alumnos
$conexion = new Alumnos();

# Obtener el criterio de ordenación
$criterio = $_GET['criterio'];

# Obtener datos de curso y alumnos
$criterioOrdenar = $_GET['$criterio'];

$alumnos = $conexion->order($criterioOrdenar);


?>