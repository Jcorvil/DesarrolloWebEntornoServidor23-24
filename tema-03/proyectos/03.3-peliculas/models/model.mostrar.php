<?php

/*

    Modelo: model.mostrar.PHP

    - Carga los datos
    - Recibo por GET indice de la película que se desea mostrar

*/

$peliculas = getPeliculas();
$paises = getPaises();
$generos = getGeneros();


$idPelicula = $_GET['id'];

$indiceBuscar = buscarEnTabla($peliculas, 'id', $idPelicula);

if ($indiceBuscar !== false) {
    $pelicula = $peliculas[$indiceBuscar];
} else {
    echo "Película no encontrada";
    exit();
}


?>