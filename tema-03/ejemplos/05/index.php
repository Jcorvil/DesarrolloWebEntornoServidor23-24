<?php
$perfil = "usuario";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plantilla HTML - BOOTSTRAP 5.3.2</title>

    <!-- css bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Iconos bootstrap 1.11.1-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>

<body>
    <!-- Capa principal -->
    <div class="container">
        <!-- Cabecera Documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-bootstrap-fill"></i>
            <span class="fs-4">Plantilla Bootstrap</span>
        </header>


        <!-- Insertar Menú de navegación -->
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Artículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Clientes</a>
                </li>


                <!-- Perfil solo para el administrador. Si perfil no es administrador, directamente no carga esta parte del HTML -->
                <?php if ($perfil == 'administrador'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin</a>
                    </li>
                <?php endif; ?>


            </ul>
        </nav>


        <!-- Pie del codumento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">
                    © 2023 Jorge Coronil Villalba - DWES - 21 DAW - Curso 23/24
                </span>
            </div>
        </footer>
    </div>

    <!-- javascript bootstrap 532 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>