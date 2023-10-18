<?php

/*
    funcion: busca_en_tabla()
    descripción: busca un elemento de la tabla
    parámetros:
                -tabla
                -nombre de la columna
                -valor que quiero buscar
    salida:     
                -índice del array donde se encuentra el valor
                -false en caso de que no lo encuentre
*/

function buscar_en_tabla($tabla = [], $columna, $valor)
{

    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);

}


function agregarLibro(&$libros)
{
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];

    $nuevoLibro = [
        "id" => $id,
        "titulo" => $titulo,
        "autor" => $autor,
        "genero" => $genero,
        "precio" => $precio,
    ];

    array_push($libros, $nuevoLibro);
}


/* 
    funcion: eliminar()
    descripción: elimina un elemento de la tabla
    parámetros:
                -tabla
                -id del elemento a eliminar
    salida:     
                -tabla actualizada
                
*/

// function eliminar($tabla = [], $id)
// {
//     //crea un array llamado lista_id que almacena los valores de la columna 'id'
//     $lista_id = array_column($tabla, 'id');

//     //Busca, dentro de todas las ids, la que se iguale a la is introducida. Si se encuentra, va a devolver el índice.
//     $elemento = array_search($id, $lista_id, false);

//     var_dump($elemento);

//     //Elimina el elemento de la tabla cuyo índice es igual a la id introducida
//     unset($tabla[$elemento]);

// }



?>