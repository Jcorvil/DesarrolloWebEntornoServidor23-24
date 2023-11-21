<?php

/*

 Modelo: model.nuevo.php

*/

setlocale(LC_MONETARY, "es_ES");

# cargamos la tabla
$paises = tablaJugadores::getPaises();
$equipos = tablaJugadores::getEquipos();
$posiciones = tablaJugadores::getPosiciones();

?>