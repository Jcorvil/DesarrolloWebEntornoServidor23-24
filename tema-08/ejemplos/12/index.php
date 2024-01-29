<?php

/*
        Ejemplo 12

        glob()

        Permite especificar un patrón
*/

// Abrir el directorio files

// Todos los archivos
$archivos = glob('files/*.txt');

print_r($archivos);

?>