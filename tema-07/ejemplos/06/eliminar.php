<?php

/* 
    eliminar.php

    Ejemplo eliminar una cookie
*/

// Eliminar cookie nombre
setcookie('datos_personales_nombre', '', time() - 3600);

// Eliminar cookie apellidos
setcookie('datos_personales_apellidos', '', time() - 3600);

echo 'Cookies eliminadas correctamente';

?>