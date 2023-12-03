<?php 

    /*

        Modelo eliminar

    */

    # Creamos objeto de la clase  curso
    $conexion = new Alumnos();

    $indice = $_GET['id'];

    $alumno = $conexion->getAlumno($indice);

    $alumno = $conexion->delete_alumno($indice);

    $alumnos = $conexion->getAlumnos();

    $notificacion = "Alumno eliminado con éxito";

?>