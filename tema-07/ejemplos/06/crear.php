<?php

/* 
    crear.php

    Ejemplo creación de cookie
*/

// Nombre de la cookie
$nombre_cookie = 'datos_personales_nombre';
$apellidos_cookie = 'datos_personales_apellidos';

// Almaceno el nombre
$nombre = 'Jorge';
$apellidos = 'Coronil Villalba';

// Expira a los 60 minutos
$expiracion = time() + 60 * 60;

setcookie($nombre_cookie, $nombre, $expiracion);
setcookie($apellidos_cookie, $apellidos, $expiracion);
echo 'Cookies creadas';


?>