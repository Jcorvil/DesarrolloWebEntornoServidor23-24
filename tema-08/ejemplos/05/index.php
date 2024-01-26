<?php

/*
    Ejemplo 5
    
*/

// Abrir archivo
$fichero = "files/ejemplo.txt";
$fp = fopen($fichero, 'rb');

// Recorrer archivo
while (!feof($fp)) {

    $linea = fgets($fp);

    echo $linea;
    echo "\n";

}

// Cerrar archivo
fclose($fp);

?>