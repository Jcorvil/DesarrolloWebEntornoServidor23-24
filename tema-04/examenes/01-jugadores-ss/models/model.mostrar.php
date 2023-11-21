<?php

$jugadores = new tablaJugadores();

$paises = tablaJugadores::getPaises();
$posiciones = tablaJugadores::getPosiciones();
$equipos = tablaJugadores::getEquipos();

$jugadores->getDatos();


$indice = $_GET['indice'];


$jugador = $jugadores->read($indice);


?>