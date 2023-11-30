<?php

    /*

        Modelo editar.php

    */

    # tomamos por GET el id del alumno a editar
    $id_editar = $_GET['id'];

    # creamos objeto de la clase conexion
    $conexion = new Alumnos();

    # extraigo los valores de los alumnos y de los cursos
    $alumnos = $conexion->getAlumnos(); 
    $cursos = $conexion->getCursos();


    $alumno = $conexion->getAlumno($id_editar);
    

?>