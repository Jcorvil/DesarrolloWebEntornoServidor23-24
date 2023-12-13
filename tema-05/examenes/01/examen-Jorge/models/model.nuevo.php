<?php

    /*
        Muestra formulario para crear nuevo libro

        Necesito obtener las editoriales y los autores para generación dinámica del combox 
        para autores y editoriales
    */

$conexion = new Libros();

$autores = $conexion->getAutores();
$editoriales = $conexion->getEditoriales();
    
?>