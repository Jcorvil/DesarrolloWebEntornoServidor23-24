<?php

/*

    Modelo Create

*/

$id = $_GET['id'];

$conexion = new Corredores();

$conexion->delete($id);

?>