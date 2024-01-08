<?php 

/*
    Ejemplo 7.5
    Variables de seisón
*/

# Continuo con la sesión


# Inicio de sesion
session_start();

echo "Sesión iniciada";
echo "<br>";
echo "SID: ". session_id();
echo "<br>";
echo "NAME: ". session_name();

# Crear variable de sesión
$_SESSION['nombre'] = 'Jorge';
$_SESSION['apellidos'] = 'Coronil Villalba';
$_SESSION['id'] = '234';

?>