<?php

/*
    Modelo: model.create.php
    Descripción: actualiza los detalles de un librro

    Método POST:
        -id
        -titulo
        -autor
        -genero
        -precio

    Método GET:
        -id
*/


//Extraemos en variables los valores del formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$precio = $_POST['precio'];


//Obtener el indice del libro que quiero editar
$id_editar = $_GET['id'];


//Obtener el indice del libro
$indice_libro_editar = buscar_en_tabla($libros, 'id', $id_editar);


//creo un array asociativo con los detalles del nuevo libro
$libro = [
    'id'=> $id,
    'titulo'=> $titulo,
    'autor'=>$autor,
    'genero'=>$genero,
    'precio'=>$precio
];

//actualizo el libro
$libros[$indice_libro_editar] = $libro;  
    
?>