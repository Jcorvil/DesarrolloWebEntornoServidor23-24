<?php 

/*
    Ejemplo 7.2
    Mostrar info sesión
*/

# Inicio de sesion
session_start();

echo "Sesión iniciada";
echo "<br>";
echo "SID: ". session_id();
echo "<br>";
echo "NAME: ". session_name();

?>