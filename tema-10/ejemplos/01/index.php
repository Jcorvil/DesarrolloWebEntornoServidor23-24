<?php


// Cabecera
$header = "Mime-Versión: 1.0" . "\n";
$header .= "Content-Type: text/html; charset-iso-8859-1" . "\n";
$header .= "From: Jorge Coronil Villalba <jcorvil600@g.educaand.es>\n";
$header .= "X-Mailer: PHP/" . phpversion();

// Parámetros
$destino = "jcorvil600@g.educaand.es";
$asunto = "Mensaje de prueba";
$mensaje = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";


// Envío

if (mail($destino, $asunto, $mensaje, $header)) {
    echo ("Corredo enviado");
} else {
    echo ("Corredo no enviado");
}


?>