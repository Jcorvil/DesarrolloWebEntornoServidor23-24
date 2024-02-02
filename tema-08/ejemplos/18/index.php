<?php

/*
    Ejemplo 18

    Para usar ZipArhive es necesario ir a php.ini y 
    descomentar la línea extension=zip
*/

// Creamos objeto de la clase ZipArchive
$zip = new ZipArchive();

// Abrir el archivo
if ($zip->open('files.zip', ZIPARCHIVE::CREATE) === true) {

    $files = glob('files/*');

    foreach ($files as $file) {
        $zip->addFile($file);
    }

    // Proceso finalizado
    $zip->close();
    echo "Carpeta comprimida correctamente";

} else {
    echo "Error";
}

?>