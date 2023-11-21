<?php

    # Creo el objeto de la clase tablaJugadores
    $jugadores = new tablaJugadores();

    # Obtengo arrays de paises, posiciones y equipos
    $paises = tablaJugadores::getPaises();
    $posiciones = tablaJugadores::getPosiciones();
    $equipos = tablaJugadores::getEquipos();

    # Cargo los datos
    $jugadores->getDatos();

    # Obtengo la tabla de jugadores mediante método getTabla()
    $t_jugadores = $jugadores->getDatos();

?>