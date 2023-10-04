<!--
    Ejercicio 1. Conversiones de datos en expresiones.

Crear un script PHP donde se muestre el tipo de dato y resultado de las siguientes expresiones matemáticas:

Multiplica valor entero con una cadena que contiene un número inicial
Sumar valor entero con cadena con número inicial
Sumar valor entero con valor float
Concatenar valor entero con cadena
Sumar valor entero con valor booleano
-->

<?php
$var1 = 5;
$var2 = "5 Hola";

$multiplicacion = $var1 * $var2;
var_dump($multiplicacion);
echo "<br>";

echo "<br>";
$sumaEntero = $var1 + $var2;
var_dump($sumaEntero);
echo "<br>";


echo "<br>";
$var3 = 10.05;
$sumaFloat = $var1 + $var3;
var_dump($sumaFloat);
echo "<br>";

echo "<br>";
$concatenacion = $var1 . $var2;
echo ($concatenacion);
echo "<br>";

echo "<br>";
$var4 = true;
$sumaBool = $var1 + $var4;
var_dump($sumaBool);
echo "<br>";



?>