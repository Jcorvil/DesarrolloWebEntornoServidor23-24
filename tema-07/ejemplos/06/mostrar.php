<?php

/* 
    mostrar.php

    Ejemplo mostrar la cookie
*/

// Accedo a la cookie
if (isset($_COOKIE['nombre'])) {
    echo $_COOKIE['nombre'];
    echo "<br>";
} else {
    echo 'Cookie no existente';
    echo "<br>";
}

if (isset($_COOKIE['apellidos'])) {
    echo $_COOKIE['apellidos'];
    echo "<br>";
} else {
    echo 'Cookie no existente';
    echo "<br>";
}
print_r($_COOKIE);

?>