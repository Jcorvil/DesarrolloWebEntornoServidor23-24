<?php

    /*

        Modelo: model.eliminar.php
        Descripcion: elimina un elemento de la  tabla

        Método GET:
                    - id del artículo que quiero eliminar

    */

    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();
    
    
    $articulos = new ArrayArticulos();
    $articulos->getDatos();


    # obtengo el  id del  artículo que deseo eliminar
    $indice = $_GET['id'];

    $articulos->delete($indice);

    $notificacion = "Artículo borrado";

   

?>