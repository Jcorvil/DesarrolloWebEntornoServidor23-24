<?php

/*
    Ejemplo 9
    
    Cambiar de directorio
*/

// Mostrar directorio actual
echo 'Directorio actual: ' . getcwd();

// Cambiar directorio actual
chdir('files');
echo "<br>";
echo 'Directorio actual: ' . getcwd();

?>