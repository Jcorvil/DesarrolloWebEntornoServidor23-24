<?php

/*Modelo principal index */

#Insertar registro en la tabla cursos de la BBDD FP
$curso = new Curso();

$curso->nombre = "Primero Desarrollo Aplicaciones Multiplataforma";
$curso->ciclo = "Desarrollo Aplicaciones Multiplataforma";
$curso->nombreCorto = "1DAM";
$curso->nivel = "1";

# Conectamos con la base de datos
$fp = new Fp();
$fp->insert_cursos($curso);

echo "Curso añadido con éxito";

?>