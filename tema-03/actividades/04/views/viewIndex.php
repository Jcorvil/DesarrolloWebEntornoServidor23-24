<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Tabla de Libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-book"></i></i></i>Tabla de Libros
            <span class="fs-6"></span>
        </header>

        <legend>Tabla de Libros</legend>

        <?php

        $libros = [
            ["id" => 1, "titulo" => "Los Señores del tiempo", "autor" => "García Sénz de Urturi", "genero" => "Novela", "precio" => 18.5],
            ["id" => 1, "titulo" => "El Rey Recibe", "autor" => "Eduardo Mendoza", "genero" => "Novela", "precio" => 20.5],
            ["id" => 1, "titulo" => "Diario de una Mujer", "autor" => "Eduardo Mendoza", "genero" => "Juvenil", "precio" => 12.95],
            ["id" => 1, "titulo" => "El Quijote de la Mancha", "autor" => "Miguel de Cervantes", "genero" => "Novela", "precio" => 15.95]
        ];


        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Género</th><th>Precio</th></tr>";

        foreach ($libros as $libro) {
            echo "<tr>";
            echo "<td>" . $libro["id"] . "</td>";
            echo "<td>" . $libro["titulo"] . "</td>";
            echo "<td>" . $libro["autor"] . "</td>";
            echo "<td>" . $libro["genero"] . "</td>";
            echo "<td>" . $libro["precio"] . "</td>";
            echo "</tr>";

        }

        echo "</table>";

        ?>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>