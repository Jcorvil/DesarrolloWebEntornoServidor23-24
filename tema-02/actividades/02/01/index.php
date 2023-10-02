<!--

Usando las funciones de conversión, ejemplo intval()

1.Asignar a una variable un valor de cualquier tipo
2.Mostrar el valor de la variable si se convierte a int
3.Mostrar el valor de la variable si se convierte a bool
4.Mostrar el valor de la variable si se convierte a string
5.Mostrar el valor de la variable si se convierte a float

-->

<!DOCTYPE html>

<body>

    <?php
    $var1 = "Hola que tal";
    $var2 = intval($var1);
    $var3 = boolval($var1);
    $var4 = strval($var1);
    $var5 = floatval($var1);

    var_dump($var1);
    echo "<br>";
    var_dump($var2);
    echo "<br>";
    var_dump($var3);
    echo "<br>";
    var_dump($var4);
    echo "<br>";
    var_dump($var5);

    ?>

</body>

</html>