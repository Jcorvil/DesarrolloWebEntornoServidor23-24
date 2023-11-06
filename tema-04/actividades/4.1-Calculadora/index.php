<?php

include ("class/class.calculadora.php");

$calculadora1 = new calculadora();
$calculadora2 = new calculadora();
$calculadora3 = new calculadora();
$calculadora4 = new calculadora();
$calculadora5 = new calculadora();



$calculadora1->setValor1(5);
$calculadora1->setValor2(3);

$calculadora2->setValor1(10);
$calculadora2->setValor2(5);

$calculadora3->setValor1(10);
$calculadora3->setValor2(2);

$calculadora4->setValor1(20);
$calculadora4->setValor2(4);

$calculadora5->setValor1(2);
$calculadora5->setValor2(5);




$resultadoSuma = $calculadora1->suma();
$resultadoResta = $calculadora2->resta();
$resultadoMult = $calculadora3->multiplicacion();
$resultadoDiv = $calculadora4->division();
$resultadoPow = $calculadora5->potencia();



echo $calculadora1->getOperacion() . ": " . $calculadora1->getValor1() . " + " . $calculadora1->getValor2() . " = " . $resultadoSuma . "<br>";
echo $calculadora2->getOperacion() . ": " . $calculadora2->getValor1() . " - " . $calculadora2->getValor2() . " = " . $resultadoResta . "<br>";
echo $calculadora3->getOperacion() . ": " . $calculadora3->getValor1() . " * " . $calculadora3->getValor2() . " = " . $resultadoMult . "<br>";
echo $calculadora4->getOperacion() . ": " . $calculadora4->getValor1() . " / " . $calculadora4->getValor2() . " = " . $resultadoDiv . "<br>";
echo $calculadora5->getOperacion() . ": " . $calculadora5->getValor1() . " ^ " . $calculadora5->getValor2() . " = " . $resultadoPow . "<br>";

?>