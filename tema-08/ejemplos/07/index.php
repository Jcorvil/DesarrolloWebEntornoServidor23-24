<?php

/*
    Ejemplo 7
    
    Obtener datos del archivo
*/

// Abrir archivo
$fichero = "files/ejemplo.txt";

$datos_archivo = stat($fichero);

print_r($datos_archivo);

?>