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

    $GLOBALS['alumno']['main'] = [1, 2, 3];
    $GLOBALS['alumno']['new'] = [1, 2];
    $GLOBALS['alumno']['edit'] = [1, 2];
    $GLOBALS['alumno']['delete'] = [1];
    $GLOBALS['alumno']['show'] = [1, 2, 3];
    $GLOBALS['alumno']['filter'] = [1, 2, 3];
    $GLOBALS['alumno']['order'] = [1, 2, 3];

