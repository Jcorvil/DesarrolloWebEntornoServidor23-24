<?php

/*
    Modelo ordenar
*/

# Creamos objeto de la clase Alumnos
$conexion = new Alumnos();

$indice = $_GET['id'];

# Obtener el criterio de ordenación
$criterio = $_GET['criterio'];

# Obtener datos de curso y alumnos
$curso = $conexion->getCurso($indice);
$alumnos = $conexion->getAlumnos();

# Obtener y ordenar alumnos según el criterio
$alumnos = $conexion->order($criterio);


?>