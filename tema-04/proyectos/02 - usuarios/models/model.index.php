<?php

    /*

        Modelo: model.index.php
        Descripcion: genera en array los datos de los artículos

    */

    setlocale(LC_MONETARY,"es_ES");
    $categorias = generar_tabla_categorias();
    $marcas = generar_tabla_marcas();
    $articulos = generar_tabla();
   

    

?>