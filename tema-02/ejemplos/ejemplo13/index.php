<?php 

    /*
        Función is_null()

        -variable no definida
    */

    //variable no definida
    var_dump(is_null($var));

    echo "<br>";

    //variable definida sin valor asignado
    $var-null;
    var_dump(is_null($var));
    echo "<br>";

    //variable eliminada
    unset($var);

?>