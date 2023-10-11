<?php

/* ejemplo 1 */
/*
for ($i = 0; $i <= 100; $i += 2) {

    echo "<br>";
    echo $i;

}
*/


/* ejemplo 2. Con valores opcionales en el for */

$i = 0;
for (; ;) {

    if ($i > 100) {
        break;
    }

    echo "<br>";
    echo $i;
    $i += 2;

}

?>