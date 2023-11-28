<?php

    /*

        Modelo: model.eliminar.php
        Descripcion: elimina un elemento de la  tabla

        Método GET:
                    - indice. del artículo que quiero eliminar

    */

    # cargamos array marcas y categorías
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();

    # cargo los artículos
    $articulos = new ArrayArticulos();
    $articulos->getDatos();

    # obtengo el  id del  artículo que deseo eliminar
    $indice = $_GET['indice'];

    # eliminar artículo
    $articulos->delete($indice);

    # notificación
    $notificacion = "Artículo eliminado con éxito";
   

?>