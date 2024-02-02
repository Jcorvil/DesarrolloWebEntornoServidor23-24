<?php

/*
    Ejemplo 19

    Descomprimir archivos

    Para usar ZipArhive es necesario ir a php.ini y 
    descomentar la línea extension=zip
*/

// Creamos objeto de la clase ZipArchive
$zip = new ZipArchive();

$zipFilename = 'files.zip';

// Abrir el archivo
if ($zip->open($zipFilename) === true) {

    $zip->extractTo('files');

    // Proceso finalizado
    $zip->close();
    echo "Carpeta extraída correctamente";

} else {
    echo "Error";
}

?>