<?php 

//Tipos de variables

# Boolean

$test = false;
echo "\$test: "; //Con la barra '\' le decimos que ponga el símbolo tal cual, sin interpretarlo.
var_dump($test);

echo "<br>";
# Int
$edad = 26;
echo "\$edad: ";
var_dump($edad);


echo "<br>";
# Float
$altura = 1.75;
echo "\$altura: ";
var_dump($altura);


echo "<br>";
# Float exponencial
$distancia = 1.75e4;
echo "\$distancia: ";
var_dump($distancia);


echo "<br>";
# String
$mensaje = "La distancia recorrida fue de $distancia km";
echo "\$mensaje";
var_dump($mensaje);


?>