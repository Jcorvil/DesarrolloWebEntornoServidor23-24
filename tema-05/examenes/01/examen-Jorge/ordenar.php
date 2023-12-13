<?php

    /*
        ordenar.php

        Permite mostrar los libros ordenados por criterio ASC a partir de las siguientes columnas:
        - id
        - titulo
        - autor
        - editorial
        - unidades
        - coste
        - pvp

    */

        include('config/config.php');

        include('class/class.conexion.php');
        include('class/class.libro.php');
        include('class/class.libros.php');
    
        include('models/model.ordenar.php');
    
        include('views/view.index.php');

?>