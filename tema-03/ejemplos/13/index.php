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

foreach($equipos as $equipo) {
    print_r($equipo);
    echo "<br>";
}


foreach($equipos as $equipo) {
    echo 'id: ' . $equipo['id'];
    echo "<br>";
    echo 'nombre: ' . $equipo['nombre'];
    echo "<br>";
    echo 'ciudad: ' . $equipo['ciudad'];
    echo "<br>";
}

?>