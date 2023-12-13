<?php

/*
     create.php

     Controlador que permite añadir un nuevo libro a la tabla libros de geslibros

*/

include('config/config.php');

include('class/class.conexion.php');
include('class/class.libro.php');
include('class/class.libros.php');

include('models/model.create.php');

header('Location: index.php');

?>