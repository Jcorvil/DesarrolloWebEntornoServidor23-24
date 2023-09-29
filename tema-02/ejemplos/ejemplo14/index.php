<?php 

    /*
        Función is_null()

        VERDADERO
            -variable no definida
            -variable asignada el valor null
        FALSO
            -asignar el valor 0
            -asignar cualquier numero entero
            -cadena definida con ""
            -un array []

    */

    //casos
    $var1 = 0;
    var_dump(is_null($var1));
    echo "<br>";
    
    $var2 = 2;
    var_dump(is_null($var2));
    echo "<br>";

    $var3 = "";
    var_dump(is_null($var3));
    echo "<br>";

    $var4 = [];
    var_dump(is_null($var4));
    echo "<br>";

?>