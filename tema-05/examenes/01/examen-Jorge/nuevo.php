<?php

    /*

        nuevo.php

        Controlador que permite acceder a geslibros, extraer la lista de Autores y Editoriales
        y mostrar el formulario que permitirá añadir nuevo libro.

    */

    include('config/config.php');

    include('class/class.conexion.php');
    include('class/class.libro.php');
    include('class/class.libros.php');

    include('models/model.nuevo.php');

    include('views/view.nuevo.php');

?>