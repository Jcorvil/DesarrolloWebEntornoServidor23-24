<?php

    /*

        Modelo: model.eliminar.php
        Descripcion: elimina un elemento de la  tabla

        Método GET:
                    - id del alumno que quiero eliminar

    */

    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();
    
    
    $alumnos = new ArrayAlumnos();
    $alumnos->getAlumnos();


    # obtengo el  id del alumno que deseo eliminar
    $indice = $_GET['id'];

    $alumnos->delete($indice);

    $notificacion = "Alumno eliminado";


?>