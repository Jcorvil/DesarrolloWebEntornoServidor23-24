<?php

/*

    Modelo: model.update.php
    Descripcion: actualiza los detalles de un corredor

*/

# obtener id del corredor
$idEditar = $_GET['id'];

# Cargamos en varibales detalles del  formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$sexo = $_POST['sexo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$categoria = $_POST['id_categoria'];
$club = $_POST['id_club'];

# Creamos un  objeto de la clase Corredor
$corredor = new Corredor();

# Asignamos valores a las propiedades
$corredor->id = null;
$corredor->nombre = $nombre;
$corredor->apellidos = $apellidos;
$corredor->ciudad = $ciudad;
$corredor->sexo = $sexo;
$corredor->fechaNacimiento = $fechaNacimiento;
$corredor->email = $email;
$corredor->dni = $dni;
$corredor->id_categoria = $id_categoria;
$corredor->id_club = $id_club;

# Se actualizan los datos

$corredores = new Corredores();
$corredores->update($corredor, $idEditar);

header('location: index.php');

?>