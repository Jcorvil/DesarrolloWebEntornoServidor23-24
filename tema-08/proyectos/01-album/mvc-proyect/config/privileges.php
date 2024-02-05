<?php

    /*
        # Perfiles
        1 - Administrador
        2 - Editor
        3 - Registrado

        # Privilegios
        Perfiles	 	Nuevo	Editar	Eliminar	 Mostrar	Buscar 	Ordenar 
        ADMINISTRADOR	SI	    SI	    SI	         SI	 SI	 SI
        eDITOR	 	    SI	    SI	    NO	         SI	 SI	SI 
        REGISTRADO	 	NO	    NO	    NO	         SI	 SI 	 SI


        # Definir privilegios como variables golbales

    */

    $GLOBALS['album']['main'] = [1, 2, 3];
    $GLOBALS['album']['new'] = [1, 2];
    $GLOBALS['album']['edit'] = [1, 2];
    $GLOBALS['album']['delete'] = [1];
    $GLOBALS['album']['show'] = [1, 2, 3];
    $GLOBALS['album']['filter'] = [1, 2, 3];
    $GLOBALS['album']['order'] = [1, 2, 3];

