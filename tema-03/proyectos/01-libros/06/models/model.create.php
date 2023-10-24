<?php


/*
    Modelo: model.create.php
    Descripción: añade un nuevo libro a la tabla

    Método POST:
        -id
        -titulo
        -autor
        -genero
        -precio
*/


//Extraemos en variables los valores del formulario

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$precio = $_POST['precio'];


//creo un array asociativo con los detalles del nuevo libro
$libro = [
    'id'=> $id,
    'titulo'=> $titulo,
    'autor'=>$autor,
    'genero'=>$genero,
    'precio'=>$precio
];

//Se añade el nuevo libro a la tabla
array_push($libros, $libro);
    
    
?>