<?php

/*

    Modelo: model.update.php
    nombre: actualiza los detalles de un alumno

    Método POST:
                - nombre
                - apellidos
                - email
                - fecha nacimiento
                - curso
                - asignaturas

    Método GET:
                - indice -> índice  del alumno que quiero editar

*/



$cursos = ArrayAlumnos::getCursos();
$asignaturas = ArrayAlumnos::getAsignaturas();

$alumnos = new ArrayAlumnos();
$alumnos->getAlumnos();


# obtener  el id  del alumno que quiero  editar
$id = $_GET['id'];



// Extraer los detalles del formulario

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$fecha_nacimiento = date('d/m/Y', strtotime($fecha_nacimiento));
$curso = $_POST['curso'];
$asignaturasNuevo = $_POST['asignaturas'];


$alumno = new Alumno(
    $nombre,
    $apellidos,
    $email,
    $fecha_nacimiento,
    $curso,
    $asignaturasNuevo
);



// $alumnos = update($alumnos, $edit_alumno, $indice);

$alumnos->update($alumno, $id);


$notificacion = "Alumno editado";

?>