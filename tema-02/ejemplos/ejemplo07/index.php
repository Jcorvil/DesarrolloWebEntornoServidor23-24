<?php

/*
    Archivo: ejemplo05.php
    Descripción: Controlador ejemplo
    Autor: Jorge Coronil
    Fecha: 26/09/2023
    
*/

$alumno = "Jorge Coronil";

print "El alumno es: "; //Con print no se pueden concatenar en la misma línea
print $alumno;

echo "<br>";

echo 123.45; //Los valores numéricos van sin comillas
echo "<br>";
print 456.789;
echo "<br>";

//echo y print son funciones, la sintáxis de PHP admite el no uso de ()

echo "El alumno es: ", $alumno; //echo puede mostrar varias cadenas

//print no admite mas de un argumento
// print "El alumno es: ". $alumno;

// Esto es un comentario con atajo de teclado
?>