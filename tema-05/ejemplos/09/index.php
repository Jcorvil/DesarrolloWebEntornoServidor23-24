<?php

/* Controlador index con PDO */

# Cargo el archivo config
include('config/config.php');

# Cargamos la librería


# Cargo clases en orden
include('class/class.conexion.php');
include('class/class.curso.php');
include('class/class.fp.php');

# Cargo modelo
include('models/model.index.php');


# Cargo la vista

?>