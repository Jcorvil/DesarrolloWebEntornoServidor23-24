<?php

/*
        Ejemplo 14

        directorios
*/

// Mostrar directorio actual
echo "Directorio actual: " . basename(getcwd()) . "<br />";
// Cambiar directorio actual
chdir('files/images');
echo "Directorio actual: " . basename(getcwd()) . "<br />";

// Crear un directorio
// mkdir('dev');
// echo 'Directorio creado';

// Eliminar una carpeta
// chdir('..');
// rmdir('dev');

// Cambiar nombre carpeta
chdir('..');
rename("images", "imagenes");
echo "Carpeta renombrada";

?>