<?php

/*
    Ejemplo 1
    
    Crear archivo de texto plano
*/

// Crear archivo para escritura. Si no existe, lo crea.

// Apertura
$fichero = "ejemplo.txt";
$fp = fopen($fichero, 'wb');

// Escritura
fwrite($fp, 'Mi primer fichero texto plano PHP');

// Cierre del archivo
fclose($fp);

echo "Fichero creado con éxito";

?>