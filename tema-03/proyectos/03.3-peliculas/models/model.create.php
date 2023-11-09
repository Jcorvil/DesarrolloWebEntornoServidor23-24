<?php

    /*

        model.create.PHP

        - Añade un elemento a la tabla 

    */

    $peliculas = getPeliculas();
    $paises = getPaises();
    $generos = getGeneros();


    $id = generarId($peliculas);
    $titulo = $_POST['titulo'];
    $pais = $_POST['pais'];
    $director = $_POST['director'];
    $generosPelicula = $_POST['generos'];
    $anno = $_POST['año'];



    $peliculaNueva = [
        'id'=> $id,
        'titulo' => $titulo,
        'pais' => $pais,
        'director' => $director,
        'generos' => $generosPelicula,
        'año' => $anno
    ];


    $peliculas[]= $peliculaNueva;
   

?>