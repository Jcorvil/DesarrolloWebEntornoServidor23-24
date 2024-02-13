<?php


// Cabecera
$header = "Mime-Versión: 1.0" . "\n";
$header .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
$header .= "From: Jorge Coronil Villalba <jcorvil600@g.educaand.es>\n";
$header .= "Cc: jcorvil600@g.educaand.es" . "\r\n";
$header .= "Cco: jcorg@g.educaand.es" . "\r\n";
$header .= "X-Mailer: PHP/" . phpversion();

// Parámetros
$destino = "jcorvil600@g.educaand.es";
$asunto = "Mensaje de prueba";
$mensaje = "<h1>Hola que tal.</h1>";


// Envío

if (mail($destino, $asunto, $mensaje, $header)) {
    echo ("Corredo enviado");
} else {
    echo ("Corredo no enviado");
}


?>