<?php 

    /*

        Modelo mostrar index

    */

    # Creamos objeto de la clase  curso
    $conexion = new Alumnos();

    $indice = $_GET['id'];

    $curso = $conexion->getCurso($indice);
    $alumno = $conexion->getAlumno($indice);

?>