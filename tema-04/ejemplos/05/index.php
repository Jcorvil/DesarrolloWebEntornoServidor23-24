<?php

include("class/class.vehiculo.php");
include("class/class.deportivo.php");


$coche_1 = new Deportivo(
    'audi 15',
    'Gama todo terreno, Audi',
    0,
    '1478 HRT',
    '400cc',
    4000
);


var_dump($coche_1);

$coche_1->velocidadMax();


?>