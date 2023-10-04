<!--

1.Asignar a una variable un valor de cualquier tipo
2.Mostrar el valor de la variable si se convierte a int
3.Mostrar el valor de la variable si se convierte a bool
4.Mostrar el valor de la variable si se convierte a string
5.Mostrar el valor de la variable si se convierte a float

-->

<?php

$var1 = "Hola que tal";

echo "<br>";
echo "Usando las funciones de conversión, ejemplo intval()";
echo "<br>";

$var2 = intval($var1);
$var3 = boolval($var1);
$var4 = strval($var1);
$var5 = floatval($var1);


var_dump($var2);
echo "<br>";
var_dump($var3);
echo "<br>";
var_dump($var4);
echo "<br>";
var_dump($var5);

echo "<br>";

echo "<br>";
echo "Usando la función settype()";
echo "<br>";

settype($var2, "integer");
settype($var3, "boolean");
settype($var4, "string");
settype($var5, "float");


var_dump($var2);
echo "<br>";
var_dump($var3);
echo "<br>";
var_dump($var4);
echo "<br>";
var_dump($var5);

echo "<br>";


echo "<br>";
echo "Haciendo la conversión de forma implícita";
echo "<br>";


$var2 = (int) $var1;
$var3 = (bool) $var1;
$var4 = (string) $var1;
$var5 = (float) $var1;


var_dump($var2);
echo "<br>";
var_dump($var3);
echo "<br>";
var_dump($var4);
echo "<br>";
var_dump($var5);

echo "<br>";

?>