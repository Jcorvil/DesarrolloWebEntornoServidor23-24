<?php

/*
        Ejemplo 11

        Abrir directorio, leer y cerrar directorio
        opendir(), readdir(), closedir()
*/

//Mostrar carpeta actual con ruta absoluta
echo "Directorio actual: " . getcwd();
echo "<br>";

if ($gestor = opendir('files')) {

    echo "Gestor de Directorio: " . $gestor;
    echo "<br>";

    // Recorro el contenido de la carpeta
    while ($entrada = readdir($gestor)) {
        // Formo la ruta completa
        $rutaCompleta = 'files/' . $entrada;

        // Verifico si es un archivo o una carpeta
        echo (is_file($rutaCompleta) ? "Archivo: " : "Carpeta: ");
        echo $entrada;
        echo "<br>";
    }

    // Cierro el gestor de directorio
    closedir($gestor);


    echo "Directorio abierto correctamente";
} else {
    echo "Error al abrir el directorio";
}

?>