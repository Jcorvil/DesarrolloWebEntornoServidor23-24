<!DOCTYPE html>

<head>
    <h1>Información del alumno y las variables</h1>
</head>

<body>

    <?php
    $nombre = "Jorge";
    $apellidos = " Coronil Villalba";
    $poblacion = "Ubrique";
    $edad = "26";
    $ciclo = "2ºDAW";
    $curso = "23/24";
    $modulo = "DWES";

    echo "<p>El alumno se llama $nombre, de apellidos $apellidos. El alumno tiene $edad años y reside en $poblacion. <br>
    Actualmente está realizando el ciclo de $ciclo en el curso $curso. Eso es una actividad de la asignatura $modulo. <br>
    La información del alumno no se ha escrito directamente, se ha almacenado en forma de variables.</p>"

    ?>

</body>

</html>