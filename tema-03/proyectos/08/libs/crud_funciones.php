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


/*
    funcion: generar_tabla()
    descripción: genera la tabla de datos con la que vamos a trabajar
    parámetros:

    salida:     
                -tabla de datos
*/

function generar_tabla()
{
    $tabla = [
        [
            "id" => 1,
            "titulo" => "Los Señores del tiempo",
            "autor" => "García Sénz de Urturi",
            "genero" => "Novela",
            "precio" => 18.5
        ],
        [
            "id" => 2,
            "titulo" => "El Rey Recibe",
            "autor" => "Eduardo Mendoza",
            "genero" => "Novela",
            "precio" => 20.5
        ],
        [
            "id" => 3,
            "titulo" => "Diario de una Mujer",
            "autor" => "Eduardo Mendoza",
            "genero" => "Juvenil",
            "precio" => 12.95
        ],
        [
            "id" => 4,
            "titulo" => "El Quijote de la Mancha",
            "autor" => "Miguel de Cervantes",
            "genero" => "Novela",
            "precio" => 15.95
        ]
    ];

    return $tabla;

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