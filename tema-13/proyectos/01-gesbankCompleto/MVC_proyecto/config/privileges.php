<?php

/*
    # Perfiles
    1 - Administrador
    2 - Editor
    3 - Registrado

    # Privilegios
    Perfiles	 	Nuevo	Editar	Eliminar  Mostrar  Buscar  Ordenar 
    ADMINISTRADOR	 SI	     SI	      SI	    SI	     SI	     SI
    EDITOR	 	     SI	     SI	      NO	    SI	     SI	     SI 
    REGISTRADO	 	 NO	     NO	      NO	    SI	     SI      SI


    # Definir privilegios como variables golbales

*/

$GLOBALS['cliente']['main'] = [1, 2, 3];
$GLOBALS['cliente']['new'] = [1, 2];
$GLOBALS['cliente']['edit'] = [1, 2];
$GLOBALS['cliente']['delete'] = [1];
$GLOBALS['cliente']['show'] = [1, 2, 3];
$GLOBALS['cliente']['filter'] = [1, 2, 3];
$GLOBALS['cliente']['order'] = [1, 2, 3];
$GLOBALS['cliente']['export'] = [1];
$GLOBALS['cliente']['import'] = [1];
$GLOBALS['cliente']['pdf'] = [1];


$GLOBALS['cuenta']['main'] = [1, 2, 3];
$GLOBALS['cuenta']['new'] = [1, 2];
$GLOBALS['cuenta']['edit'] = [1, 2];
$GLOBALS['cuenta']['delete'] = [1];
$GLOBALS['cuenta']['show'] = [1, 2, 3];
$GLOBALS['cuenta']['filter'] = [1, 2, 3];
$GLOBALS['cuenta']['order'] = [1, 2, 3];
$GLOBALS['cuenta']['export'] = [1];
$GLOBALS['cuenta']['import'] = [1];
$GLOBALS['cuenta']['pdf'] = [1];
$GLOBALS['cuenta']['showMov'] = [1, 2, 3];

$GLOBALS['contacto']['validar'] = [1, 2, 3];
$GLOBALS['contacto']['render'] = [1, 2, 3];

$GLOBALS['movimiento']['main'] = [1, 2, 3];
$GLOBALS['movimiento']['new'] = [1, 2];
$GLOBALS['movimiento']['show'] = [1, 2, 3];
$GLOBALS['movimiento']['filter'] = [1, 2, 3];
$GLOBALS['movimiento']['order'] = [1, 2, 3];

$GLOBALS['user']['main'] = [1];
$GLOBALS['user']['new'] = [1];
$GLOBALS['user']['delete'] = [1];
$GLOBALS['user']['edit'] = [1];
$GLOBALS['user']['show'] = [1];
$GLOBALS['user']['filter'] = [1];
$GLOBALS['user']['order'] = [1];


?>