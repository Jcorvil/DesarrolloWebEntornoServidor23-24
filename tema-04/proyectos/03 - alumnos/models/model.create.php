<?php

    /*

        Modelo: model.create.php
        nombre: añade un nuevo alumno en a la tabla

        Método POST:
                    - id
                    - nombre
                    - apellidos
                    - email
                    - fecha nacimiento
                    - curso
                    - asignaturas

    */

    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();

    $alumnos = new ArrayAlumnos();
    $alumnos->getAlumnos();


    #Cargo en variables los detalles del alumno
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_nacimiento = date('d/m/Y', strtotime($fecha_nacimiento));
    $curso = $_POST['curso'];
    $asignaturasNuevo = $_POST['asignaturas'];
    

    #Creo un objeto clase alumno a partir de los detalles del formulario
    $alumno = new Alumno(
        $id,
        $nombre,
        $apellidos,
        $email,
        $fecha_nacimiento,
        $curso,
        $asignaturasNuevo
    );

    
    #Añado el alumno al array de alumnos
    $alumnos->create($alumno);

    #Genero notificación
    $notificacion = "Alumno añadido con éxtio";

?>