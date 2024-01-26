<?php

/*
    Ejemplo 4
    
*/

//  lectura y modificación archivo completo

// Lectura
$fichero = "files/ejemplo.txt";
$cadena = file_get_contents($fichero);

var_dump($cadena);

$cadena = $cadena . "\n". "Nueva línea";

file_put_contents($fichero, $cadena);

?>