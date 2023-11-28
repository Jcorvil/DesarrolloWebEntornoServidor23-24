<?php

/* *******************************************
    function buscar_en_tabla()
    descripcion: busca un valor en una determinada columna de una tabla
    parámetros:
                - tabla
                - columna - búsqueda
                - valor - que quiero buscar
    salida:
                - indice del array donde se encuentra el valor
                - false - en caso de no lo encuentre
*/

function buscar_en_tabla($tabla = [], $columna, $valor)
{

    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);

}

/* ************************************************
    Generar la tabla de marcas
*/
# Genero la tabla de marcas
function generar_tabla_categorias(){

    $categorias = [
        'Portátiles',
        'PCs sobremesa',
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

/* ************************************************
    Generar la tabla de marcas
*/
# Genero la tabla de marcas
function generar_tabla_marcas(){

    $marcas = [
        'Xiaomi',
        'Acer',
        'Aoc',
        'Nokia',
        'Apple',
        'Lenovo',
        'IBM'
    ];

    asort($marcas);
    return $marcas;
}

/* ***************************************
    function generar_tabla()
    descripcion: genera la tabla de datos con la que vamos a trabajar
    parámetros:
                
    salida:
                - tabla de datos
        
*/
function generar_tabla()
{

    $tabla = [

        [
            'id' => 1,
            'descripcion' => 'Portátil HP MD12345',
            'modelo' => 'HP 15-1234-20',
            'marca' => 0,
            'categorias' => [1,2,3],
            'unidades' => 12,
            'precio' => 550.50
        ],
        [
            'id' => 2,
            'descripcion' => 'Tablet - Samsung Galaxy Tab A (2019)',
            'modelo' => 'Exynos',
            'marca' => 5,
            'categorias' => [2,3,5],
            'unidades' => 200,
            'precio' => 300
        ],
        [
            'id' => 3,
            'descripcion' => 'Impresora multifunción - HP',
            'modelo' => 'DeskJet 3762',
            'marca' => 4,
            'categorias' => [2,4,1],
            'unidades' => 2000,
            'precio' => 69
        ],
        [
            'id' => 4,
            'descripcion' => 'TV LED 40" - Thomson 40FE5606 - Full HD',
            'modelo' => 'Thomson 40FE5606',
            'marca' => 3,
            'categorias' => [1,3,4],
            'unidades' => 300,
            'precio' => 259
        ],
        [
            'id' => 5,
            'descripcion' => 'PC Sobremesa - Acer Aspire XC-830',
            'modelo' => 'Acer Aspire XC-830',
            'marca' => 1,
            'categorias' => [3,5],
            'unidades' => 20,
            'precio' => 329
        ]

    ];

    return $tabla;

}

 /* ***************************
    Function: nuevo()
    Descripción: Añade un nuevo elemento a la tabla
    Entrada:
            - tabla (array)
            - nuevo registro de la tabla (array indexado)
    Salida:
            - tabla actualizada
*/
function nuevo($tabla, $registro) {

    $tabla[] = $registro;
    return $tabla;

}

/* ***************************************************
    Function: read()
    Descripción: Obtiene un valor a partir del índice de un array
    Entrada:
            - tabla (array)
            - indice
    Salida:
            - registro
*/
function read($tabla, $indice) {

    $registro = $tabla[$indice];
    return $registro;

}

/* **************************************
    Function: update()
    Descripción: Actualiza los datos de un articulo
    Entrada:
            - tabla (array)
            - registro
            - indice
    Salida:
            - tabla actualizada
*/
    function update($tabla, $registro, $indice) {

        $tabla[$indice] = $registro;
        return $tabla;

    }

/* *****************************************
    Function: ordenar()
    Descripción: Ordena la tabla por alguno de los campos. Ascendente
    Entrada:
            - tabla (array)
            - criterio de ordenación
    Salida:
            - tabla ordenada
*/
function ordenar($tabla, $criterio) {

    # Crea un array con los valores del campo 
    # por el que quiero ordenar
    $aux = array_column($tabla, $criterio);

    array_multisort($aux, SORT_ASC, $tabla);

    return ($tabla);

}

/* *********************************************
    Function: filtrar()
    Descripción: filtra la tabla a partir de una expresión de búsqueda
    Entrada:
            - tabla (array)
            - criterio de búsqueda
    Salida:
            - tabla filtrada
*/
function filtrar($tabla, $expresion) {

    # Recorro la tabla
    # Busco la expresión en cada registro mediante la función in_array()
    
    $aux=[];

    foreach ($tabla as $registro) {
        if  (array_search($expresion, $registro)) {
            
                $aux[] = $registro;
        }
    }

    if (empty($aux)){
        $aux = $tabla;
    }
    
    return ($aux);

}

/* ***************************************
    function: generar_id()
    descripción: genera el próximo id de la tabla
    parametros:
        - $tabla de datos
*/
function generar_id($tabla) {

    $array_id = array_column($tabla,'id');
    asort($array_id);
    return  end($array_id) + 1;

}

function mostrarCategorias($categorias, $categoriasArticulo) {

    $arrayCategorias = [];

    foreach($categoriasArticulo as $indice) {

        $arrayCategorias[] = $categorias[$indice];

    }

    asort($arrayCategorias);
    return $arrayCategorias;

}



?>