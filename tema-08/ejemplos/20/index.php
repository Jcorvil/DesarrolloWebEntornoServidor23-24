<?php

/*
    Ejemplo 20

    Descarga de archivos

    Para usar ZipArhive es necesario ir a php.ini y 
    descomentar la línea extension=zip
*/

// Determinamos el nombre del archivo para descargar
$file = 'files.zip';

if (file_exists($file)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);

    exit();

} else {
    echo 'El archivo no existe.';
}
?>