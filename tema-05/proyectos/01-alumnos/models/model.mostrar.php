<?php

/*

    Modelo: model.mostrar.php
    Descripcion: muestra los detalles de un artículo sin edición

    Método GET:
                - indice del artículo
*/

# cargamos la tabla
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

# Creamos un objeto de la clase ArrayArticulos
$articulos = new ArrayArticulos();

# Cargo los datos
$articulos->getDatos();

# obtener indice del artículo que voy a editar
$indice = $_GET['indice'];

# cargo los detalles del artículo a partir del índice
# en objeto de la clase Articulo
$articulo = $articulos->read($indice);

?>