<?php

/*
    Ejemplo 7
    
    Obtener daatos del archivo
*/

// Abrir archivo
$fichero = "files/ejemplo.txt";

$datos_archivo = stat($fichero);

print_r($datos_archivo);

?>