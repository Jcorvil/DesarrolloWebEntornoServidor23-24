<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proyecto 2.1 - Calculadora Básica</title>

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
            <i class="bi bi-rocket-takeoff"></i>
            <span class="fs-4">Proyecto 2.2 - Lanzamiento de proyectiles</span>
            <i class="bi bi-rocket-takeoff"></i>
        </header>

        <form>

            <!-- Valores -->
            <table class="table">
                <tbody>
                    <tr>
                        <th>Valores Iniciales:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Velocidad Inicial:</td>
                        <td>
                            <?= $velocidad ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Ángulo de inclinación:</td>
                        <td>
                            <?= $angulo ?> º
                        </td>
                    </tr>
                    <tr>
                        <th>Resultados:</th>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Ángulo radianes:</td>
                        <td>
                            <?= $anguloRadianes ?> radianes
                        </td>
                    </tr>
                    <tr>
                        <td>Velocidad inicial X:</td>
                        <td>
                            <?= $velInicialX ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Velocidad inicial Y:</td>
                        <td>
                            <?= $velInicialY ?> m/s
                        </td>
                    </tr>
                    <tr>
                        <td>Alcance Máximo del Proyectil: </td>
                        <td>
                            <?= $alcanceMax ?> m
                        </td>
                    </tr>
                    <tr>
                        <td>Tiempo de Vuelo del proyectil:</td>
                        <td>
                            <?= $tiempoVuelo ?> s
                        </td>
                    </tr>
                    <tr>
                        <td>Altura máxima del proyectil:</td>
                        <td>
                            <?= $alturaMax ?> m
                        </td>
                    </tr>
                </tbody>
            </table>


            <!-- Botones de acción -->

            <div class="btn-group" role="group">
                <a class="btn btn-primary" href="index.php" role="button">Volver</a>
            </div>


        </form>

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