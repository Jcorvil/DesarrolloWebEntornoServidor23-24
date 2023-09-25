<?php 
    include 'usuario.php'; //Se puede hacer el script php aparte y enlazarlo
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Ejemplo 01 - Tema 2</title>
</head>

<body>
    <center>
        <h2>Ejemplo 01 - Tema 2</h2>
    </center>
    <h2>
        <?php //Lo que esté entre las etiquetas <?php y > se ejecutará como script php
        echo "Hola mundo.";
        echo "<br>"; //Salto de línea
        echo "Soy $usuario"; //Uso de variables
        ?>
    </h2>
</body>

</html>