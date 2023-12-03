<?php 


    /*
     * Controlador nuevo con PDO
    */

    # Cargamos configuración
    include('config/db.php');

    # Cargamos librería de funciones

    # Cargamos clases en orden
    include('class/class.conexion.php');
    include('class/class.alumno.php');
    include('class/class.alumnos.php');

    # Cargo modelo
    include('models/model.nuevo.php');

    # Cargo vista
    include('views/view.nuevo.php');

?>