<?php

/*
    Modelo: model.create.php
    Descripción: actualiza los detalles de un librro

    Método POST:
        -id
        -descripcion
        -modelo
        -categoria
        -unidades
        -precio

    Método GET:
        -id
*/

$categorias = generar_tabla_categorias();

#Cargo la tabla
$articulos = generar_tabla();

//Extraemos en variables los valores del formulario
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$categoria = $_POST['categoria'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];


//Obtener el indice del libro que quiero editar
$id_editar = $_GET['id'];


//Obtener el indice del libro
$indice_articulo_editar = buscar_en_tabla($articulos, 'id', $id_editar);


//creo un array asociativo con los detalles del nuevo libro
$articulo = [
    'id'=> $id,
    'descripcion'=> $descripcion,
    'modelo'=>$modelo,
    'categoria'=>$categoria,
    'unidades'=>$unidades,
    'precio'=>$precio
];

//actualizo el libro
$articulos[$indice_articulo_editar] = $articulo;  
    
?>