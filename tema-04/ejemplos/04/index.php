<?php

include("class/class.vehiculo.php");


$coche_1 = new Vehiculo(
    'audi 15',
    'Gama todo terreno, Audi',
    0,
    '1478 HRT',
);

var_dump($coche_1);

var_dump($coche_1->getMatricula());

$coche_1->aumentarVelocidad();

var_dump($coche_1);

unset($coche_1);

?>