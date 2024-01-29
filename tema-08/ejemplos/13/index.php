<?php

/*
        Ejemplo 13

        directorios
*/

// Mostrar directorio actual
echo "Directorio actual: " . getcwd() . "<br />";
// Mostrar directorio padre
echo "Directorio actual: " . dirname(getcwd()) . "<br />";
// Mostrar nombre del directorio actual
echo "Directorio actual: " . basename(getcwd()) . "<br />";
// Devolver info sobre una ruta
$detalles = pathinfo(getcwd());
echo "Directorio actual: " . $detalles['basename'] . "<br />";

?>