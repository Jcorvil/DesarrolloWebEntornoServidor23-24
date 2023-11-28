<?php

    /*

        Modelo: model.create.php
        Descripcion: añade un nuevo  alumno a la tabla alumnos de la bbdd fp

        Método POST:
                    - id 
                    - nombre
                    - apellidos
                    - email
                    - telefono
                    - direccion
                    - poblacion
                    - provincia
                    - nacionalidad
                    - dni
                    - fechaNac
                    - id_curso

    */

    # Cargamos en varibales detalles del  formulario
    $nombre         = $_POST['nombre'];
    $apellidos      = $_POST['apellidos'];
    $email          = $_POST['email'];
    $telefono       = $_POST['telefono'];
    $direccion      = $_POST['direccion'];
    $poblacion      = $_POST['poblacion'];
    $provincia      = $_POST['provincia'];
    $nacionalidad   = $_POST['nacionalidad'];
    $dni            = $_POST['dni'];
    $fechaNac       = $_POST['fechaNac'];
    $id_curso       = $_POST['id_curso'];

    # Creamos un  objeto de la clase Alumno
    $alumno = new Alumno();

    # Asignamos valores a las propiedades
    $alumno->id = null;
    $alumno->nombre = $nombre;
    $alumno->apellidos = $apellidos;
    $alumno->email = $email;
    $alumno->telefono = $telefono;
    $alumno->direccion = $direccion;
    $alumno->poblacion = $poblacion;
    $alumno->provincia = $provincia;
    $alumno->nacionalidad = $nacionalidad;
    $alumno->dni = $dni;
    $alumno->fechaNac = $fechaNac;
    $alumno->id_curso = $id_curso;

    # Validación

    # Insertar registro
    $fp = new Fp();
    $fp->insertAlumno($alumno);

    // No debo cargar la vista view.index.php
    // Tengo que cargar el controlador index.php
    header('location: index.php');
?>