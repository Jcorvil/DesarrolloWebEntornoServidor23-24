<?php

/*

    Modelo Order

*/

# Creamos objeto de la clase Corredores
$conexion = new Corredores();

# Obtener el criterio de ordenación
$criterio = $_GET['criterio'];

$corredores = $conexion->order($criterio);

?>