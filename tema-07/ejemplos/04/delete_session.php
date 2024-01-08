<?php 

/*
    Ejemplo 7.4
    Destruir sesion
*/

# Continuo con la sesión


# Inicio de sesion
session_start();

echo "Sesión iniciada";
echo "<br>";
echo "SID: ". session_id();
echo "<br>";
echo "NAME: ". session_name();

# Elimino sesión
session_destroy();

echo "<br>";
echo "<br>";
echo "Sesión borrada";
echo "<br>";
echo "SID: ". session_id();
echo "<br>";
echo "NAME: ". session_name();

?>