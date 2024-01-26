<?php

/*
    Ejemplo 6
    
    Obtener información del archivo
*/

// Abrir archivo
$fichero = "files/ejemplo.txt";

if (is_file($fichero)) {
    echo 'Es un fichero';
    echo "<br>";
    echo 'Tamaño fichero: ' . filesize($fichero) . "bytes ";
    echo "<br>";
    echo 'Fecha: ' . date('d/m/Y H:i:s', filemtime($fichero));
    echo "<br>";
    echo 'Tipo: ' . filetype($fichero);
}

echo "<br>";
echo "<br>";

if (is_dir('files')) {
    echo 'Files ' . 'Es una carpeta';
}

?>