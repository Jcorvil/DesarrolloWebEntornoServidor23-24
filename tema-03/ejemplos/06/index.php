<?php
/*
    Ejemplo
    Script php que muestre los 10 primeros números del 1 al 10
*/

echo"Usando un while";
echo "<br>";

$num1 = 1;
while ($num1 <= 10) {
    echo $num1;
    echo "<br>";
    $num1++;
}

echo "<br>";
echo "<br>";


/*
    Forma alternativa
*/

echo"Usando un while de forma alternativa";
echo "<br>";

$num2 = 1;
while ($num2 <= 10):
    echo $num2;
    echo "<br>";
    $num2++;
endwhile;

?>