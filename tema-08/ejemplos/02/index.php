<?php

/*
    Ejemplo 2
    
    Añadir texto al final del fichero
*/


// Apertura
$fichero = "ejemplo.txt";
// 'a' abre el archivo, pero coloca el puntero al final del archivo.
$fp = fopen($fichero, 'ab');

// Escritura
fwrite($fp, "\n");
fwrite($fp, 'Esta nueva línea');

// Cierre del archivo
fclose($fp);

echo "Fichero creado con éxito";

?>