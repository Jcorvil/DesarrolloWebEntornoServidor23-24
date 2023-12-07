<?php

/*

    Modelo Create

*/

$id = $_GET['id'];

$conexion = new Corredores();

$categoria = $conexion->getCategoria($id);
$club = $conexion->getClub($id);

$corredor = $conexion->read($id);

?>