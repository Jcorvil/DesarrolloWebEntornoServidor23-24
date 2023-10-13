<?php 

    $numeros = array(4, 5, 7, 10, 60, 90);

    //$numeros = array(0=>4, 1=>5, 2=>7, 3=>10, 4=>60, 5=>90); Forma alternativa

    for ($i = 0; $i <= 5; $i++){
        echo $i;
        echo "=>";
        echo $numeros[$i];
        echo "<br>";
    }


?>