<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Subida archivos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
                crossorigin="anonymous">
</head>

<body>
        <div class="container">
                <h1>Formulario subida de archivos</h1>
                <!-- Formulario -->
                <form action="validar.php" method="POST" enctype="multipart/form-data">
                        <!-- Campo oculto para validar tamaño del archivo -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                        <!-- Nombre -->
                        <div class=" mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Nombre completo">
                        </div>
                        <!-- Observaciones -->
                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control" id="exampleFormControlTextarea1"
                                        rows="3" placeholder="Introduzca observaciones del archivo"></textarea>
                        </div>
                        <!-- fichero -->
                        <div class="mb-3">
                                <label for="formFile" class="form-label">Seleccionar archivo</label>
                                <input name="fichero" class="form-control" type="file" id="formFile"  accept="image/*">
                        </div>
                        <!-- Botones de acción -->
                        <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
                <div class="container">
                        <span class="text-muted">© 2024
                                Jorge Coronil Villalba - DWES - 2º DAW - Curso 23/24</span>
                </div>
        </footer>

</body>

</html>