<?php

    /*

        Modelo: model.buscar.php
        Descripcion: filtra los artículos  a partir de la expresión búsqueda

        Método GET:
                    - expresion: prompt o expresión de búsqueda
    */

    # Cargo los datos
    $categorias = generar_tabla_categorias();
    $articulos = generar_tabla();

    # Cargo la expresion de búsqueda
    $expresion = $_GET['expresion'];

    # Filtrar la tabla  a partir de esa expresión
    $articulos  = filtrar($articulos, $expresion);


?>