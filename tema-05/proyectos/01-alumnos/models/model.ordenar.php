<?php

/*

    Modelo: model.ordenar.php
    Descripcion: muestra los artículos  a partir de un  criterio de ordenación

    Método GET:
                - critero: descripcion, modelo,  categoria, unidades, precio
*/

# cargamos la tabla
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

# Creamos un objeto de la clase ArrayArticulos
$articulos = new ArrayArticulos();

# Cargo los datos
$articulos->getDatos();

# Cargo el criterio de ordenación
$criterio = $_GET['criterio'];



# Ordenar tabla articulos
$articulos = ordenar($articulos, $criterio);

?>