<?php

include("class/class.vehiculo.php");
$coche_1 = new Vehiculo();

var_dump($coche_1);

var_dump($coche_1->getMatricula());

$coche_1->setModelo("audi q5");
$coche_1->setNombre("Gama todo terreno, Audi");
$coche_1->setMatricula("1478 HRT");
$coche_1->setVelocidad(0);

$coche_1->aumentarVelocidad();

var_dump($coche_1);

?>