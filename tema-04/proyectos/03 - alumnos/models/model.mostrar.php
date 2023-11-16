<?php

    /*

        Modelo: model.mostrar.php
        Descripcion: muestra los detalles de un artículo sin edición

        Método GET:
                    - id del artículo que quiero editar

    */

    #Cargamos los arrays a partir de los métodos estáticos de la clase
    #ArrayAlumnos
    $cursos = ArrayAlumnos::getCursos();
    $asignaturas = ArrayAlumnos::getAsignaturas();

    #Creamos un objeto de la clase ArrayAlumnos
    $alumnos = new ArrayAlumnos();

    $alumnos->getAlumnos();


    # obtener  el id  del artículo que quiero mostrar
    $indice = $_GET['id'];

    
    $alumno = $alumnos->read($indice);

?>