<?php


$paises = tablaJugadores::getPaises();
$posiciones = tablaJugadores::getPosiciones();
$equipos = tablaJugadores::getEquipos();

$jugadores = new tablaJugadores();
$jugadores->getDatos();


$idNuevo = $_POST['id'];
$nombreNuevo = $_POST['nombre'];
$numeroNuevo = $_POST['numero'];
$paisNuevo = $_POST['pais'];
$equipoNuevo = $_POST['equipo'];
$posicionesNuevo = $_POST['posiciones'];
$contratoNuevo = $_POST['contrato'];




$jugador = new Jugador(
    $idNuevo,
    $nombreNuevo,
    $numeroNuevo,
    $paisNuevo,
    $equipoNuevo,
    $posicionesNuevo,
    $contratoNuevo
);



$jugadores->create($jugador);

$t_jugadores = $jugadores->getTabla();

$notificacion = "Jugador añadido con éxtio";

?>