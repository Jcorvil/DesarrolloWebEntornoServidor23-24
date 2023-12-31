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

/*Generar la tabla categorías */

function generar_tabla_categorias()
{
    $categorias = [
        'Portátiles',
        'PCs Sobremesa',
        'Componentes',
        'Pantallas',
        'Impresoras',
        'Tablets',
        'Móviles',
        'Fotografía',
        'Imagen'
    ];

    asort($categorias);

    return $categorias;
}


function generar_tabla()
{

    $tabla = [
        [
            'id' => 1,
            'descripcion' => 'Portátil - HP 15-D00774NS',
            'modelo' => 'HP 15-DB0074NS',
            'categoria' => 0,
            'unidades' => 120,
            'precio' => 379
        ],
        [
            'id' => 2,
            'descripcion' => 'Portátil - AMD A4-9125, 8GB RAM, 125GB',
            'modelo' => 'HP 255 G7, 15.6',
            'categoria' => 0,
            'unidades' => 200,
            'precio' => 550.50
        ],
        [
            'id' => 3,
            'descripcion' => 'PC Sobremesa - Lenovo Intel© Core™ i3-8100',
            'modelo' => 'ideacentre 510S-07ICB',
            'categoria' => 1,
            'unidades' => 50,
            'precio' => 12.95
        ],
        [
            'id' => 4,
            'descripcion' => 'PC Sobremesa - HP 290 APU AMD Dual-Core A6',
            'modelo' => 'HP 290-a0002ns',
            'categoria' => 1,
            'unidades' => 50,
            'precio' => 15.95
        ],
        [
            'id' => 5,
            'descripcion' => 'Monitor gaming - LG 24GN60R-B',
            'modelo' => '24GN60R-B',
            'categoria' => 3,
            'unidades' => 80,
            'precio' => 161.50
        ],
        [
            'id' => 6,
            'descripcion' => 'GEFORCE RTX™ 4080 GAMING OC 16GB GDRR6X',
            'modelo' => 'GDRR6X',
            'categoria' => 2,
            'unidades' => 25,
            'precio' => 480.50
        ]
    ];

    return $tabla;
}


function nuevo($tabla, $registro)
{

    $tabla[] = $registro;
    return $tabla;

}


function ultimoID($tabla)
{
    $array_id = array_column($tabla, 'id');
    asort($array_id);
    return end($array_id) + 1;

}


function actualizar($tabla, $id_editar)
{

    $articulos = generar_tabla();

    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $categoria = $_POST['categoria'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];


    $id_editar = $_GET['id'];


    $indice_articulo_editar = buscar_en_tabla($articulos, 'id', $id_editar);


    $articulo = [
        'id' => $id,
        'descripcion' => $descripcion,
        'modelo' => $modelo,
        'categoria' => $categoria,
        'unidades' => $unidades,
        'precio' => $precio
    ];


    $articulos[$indice_articulo_editar] = $articulo;

    return $tabla;

}


function ordenar($tabla, $criterio)
{
    $criterio = $_GET['criterio'];
    $aux = array_column($tabla, $criterio);

    if (!in_array($criterio, array_keys($tabla[0]))) {
        echo "ERROR: Criterio de ordenación inexistente";
        exit();

    }

    array_multisort($aux, SORT_ASC, $tabla);

    return $aux;

}

function eliminar($tabla, $id)
{

    $indice_eliminar = buscar_en_tabla($tabla, 'id', $id);

    if ($indice_eliminar !== false) {

        unset($tabla[$indice_eliminar]);

        $tabla = array_values($tabla);

    } else {
        echo 'ERROR: Libro no encontrado';
        exit();
    }

    return $tabla;
}


?>