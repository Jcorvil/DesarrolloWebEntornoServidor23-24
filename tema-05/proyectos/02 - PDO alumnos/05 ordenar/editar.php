<?php

    /*
        Controlador editar con PDO
    */

    # Cargamos configuración
    include('config/db.php');

    # Cargamos librería de funciones

    # Cargamos clases en orden
    include('class/class.conexion.php');
    include('class/class.alumno.php');
    include('class/class.alumnos.php');

    # Cargo modelo
    include('models/model.editar.php');

    # Cargo vista
    include('views/view.editar.php');

?>