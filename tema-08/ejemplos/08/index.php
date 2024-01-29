<?php

/*
    Ejemplo 8
    
    Copiar, mover, cambiar nombre, eliminar
*/

// Copia arhivo

// Una nueva versión
// copy('datos.txt', 'datos2.txt');
// echo'Archivo copiado correctamente';

// Copiar archivo en una nueva carpeta
// copy('datos2.txt', 'files/datos2.txt');
// echo'Archivo copiado correctamente';

// Copiar archivo en otra cacrpeta cambio nombre
// copy('datos2.txt', 'files/datos.txt');
// echo'Archivo copiado correctamente';

// Machacar al copiar
// copy('datos.txt', 'files/datos.txt');
// echo'Archivo copiado correctamente';

// Cambiar nombre
// rename('datos.txt', 'detalles.txt');
// echo 'Operación realizada con éxito';

// Mover archivo
// rename('detalles.txt', 'files/detalles.txt');
// echo 'Operación realizada con éxito';

// Eliminar archivo
unlink('datos2.txt');
echo 'Archivo eliminado';

?>