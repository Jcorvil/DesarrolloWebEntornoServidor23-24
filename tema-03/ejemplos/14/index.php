<?php

/*
    Arrays asociativos
    Valor del indice personalizado con un número o string
*/

$equipos = [
    [
        'id' => 1,
        'nombre' => 'Real Madrid',
        'ciudad' => 'Madrid'
    ],
    [
        'id' => 2,
        'nombre' => 'Real betis',
        'ciudad' => 'Sevilla'
    ],
    [
        'id' => 3,
        'nombre' => 'FC Barcelona',
        'ciudad' => 'Barcelona'
    ]
];


foreach ($equipos as $equipo) {
    foreach ($equipo as $key => $dato) { //
        echo "$key: " .$dato;
        echo "<br>";
    }
}

?>