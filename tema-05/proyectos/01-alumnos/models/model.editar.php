<?php

/*

    Modelo: model.editar.php
    Descripcion: edita los detalles de un alumno

    Método GET:
                - id alumno

*/

# Id del alumno que voy a editar
$id = $_GET['id'];

# Conectamos BBDD fp y extraemos los cursos
$fp = new Fp();
$cursos = $fp->getCursos();

# Obtengo un objeto de la clase Alumno los detalles del alumno
$alumno = $fp->readAlumno($id);


?>