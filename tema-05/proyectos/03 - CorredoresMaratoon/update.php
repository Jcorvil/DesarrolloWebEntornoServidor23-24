<?php

/*
    Controlador principal index con PDO
*/

# Cargamos configuración
include('config/db.php');

# Cargamos librería de funciones

# Cargamos clases en orden
include('class/class.conexion.php');
include('class/class.corredor.php');
include('class/class.corredores.php');

# Cargo modelo
include('models/model.update.php');

# Cargo vista
header('Location: index.php');

?>