<?php

/*
    Ejemplo 7.5
    Mostrar variables de seisón
*/

# Continuo con la sesión


# Inicio de sesion
session_start();

print_r($_SESSION);

echo "<br>";

# Crear variable de sesión
$_SESSION['nombre'] = 'Jorge';
echo "<br>";
$_SESSION['apellidos'] = 'Coronil Villalba';
echo "<br>";
$_SESSION['id'] = '234';

echo 'Variables creadas';

?>