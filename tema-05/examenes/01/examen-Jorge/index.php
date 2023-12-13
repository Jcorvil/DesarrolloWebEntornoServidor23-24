<?php

    /*

        index.php

        Controlador que permite realizar una consulta de libros en geslibros y mostrarlos en
        una vista a partir del diseño establecido

    */

        include('config/config.php');

        include('class/class.conexion.php');
        include('class/class.libro.php');
        include('class/class.libros.php');
    
        include('models/model.index.php');
    
        include('views/view.index.php');

?>