<?php 

    $numeros = array(4, 5, 7, 10, 60, 90, 100);


    unset($numeros[3]);

    $numeros[3] = 900;

    foreach ($numeros as $numero) {
        echo $numero;
        echo "<br>";

    }

    print_r($numeros);

?>