<?php

/*
    Ejemplo 17

    Para usar ZipArhive es necesario ir a php.ini y 
    descomentar la línea extension=zip
*/

// Creamos objeto de la clase ZipArchive
$zip = new ZipArchive();

// Abrir el archivo
if ($zip->open('files.zip', ZIPARCHIVE::CREATE) === true) {

    // Añadir ficheros para comprimir
    // Segundo parámetro opcional. Permite cambiar el nombre del fichero
    $zip->addFile('files/fichero1.php', 'files/fichero1.php');
    $zip->addFile('files/fichero2.png', 'files/fichero2.png');
    $zip->addFile('files/fichero3.sql', 'files/fichero3.sql');
    $zip->addFile('files/fichero4.war', 'files/fichero4.war');

    // Proceso finalizado
    $zip->close();
    echo "Archivo comprimido correctamente";

} else {
    echo "Error";
}

?>