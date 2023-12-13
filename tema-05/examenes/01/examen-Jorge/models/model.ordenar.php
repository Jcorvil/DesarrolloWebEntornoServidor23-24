<?php

/*  
     model.ordenar.php

 */


$conexion = new Libros();

$criterio = $_GET['criterio'];

$libros = $conexion->order($criterio);


?>