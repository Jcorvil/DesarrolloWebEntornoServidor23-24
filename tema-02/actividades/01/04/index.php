<?php

$varFloat = 10.5;
$varInt = 10;

$suma = $varFloat + $varInt;
$resta = $varFloat - $varInt;
$division = $varFloat / $varInt;
$producto = $varFloat * $varInt;
$potencia = pow($varFloat, $varInt);

echo "Suma: ";
var_dump($suma);
echo "<br>";

echo "Resta: ";
var_dump($resta);
echo "<br>";

echo "División: ";
var_dump($division);
echo "<br>";

echo "Producto: ";
var_dump($producto);
echo "<br>";

echo "Potencia: ";
var_dump($potencia);
echo "<br>";

?>