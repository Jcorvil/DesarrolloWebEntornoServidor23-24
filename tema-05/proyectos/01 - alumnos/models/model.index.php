<?php

    /*

        Modelo: model.index.php
        Descripcion: Crear un array con los detalles de los alumnos

    */

    setlocale(LC_MONETARY,"es_ES");

    //Conecto con la base de datos
    $db = new Fp();

    //Objeto result con los detalles del alumno
    $alumnos = $db->getAlumnos();




?>