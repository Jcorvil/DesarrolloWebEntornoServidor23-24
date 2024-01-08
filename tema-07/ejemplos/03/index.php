<?php 

/*
    Ejemplo 7.3
    Personalizar sesión
*/

# Personalizar sesión
session_id('100101000111');
session_name('GESBANK_ini');

# Inicio de sesion
session_start();

echo "Sesión iniciada";
echo "<br>";
echo "SID: ". session_id();
echo "<br>";
echo "NAME: ". session_name();

?>