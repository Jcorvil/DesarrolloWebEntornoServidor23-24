<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subir Archivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Formulario Subida Archivos</h1>

        <!-- Error -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR</strong>
                <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Mensaje -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Mensaje</strong>
                <?= $mensaje ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- formulario -->
        <form method="POST" enctype="multipart/form-data">

            <!-- campo oculto validar tamaño archivo -->
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152">

            <!-- nombre -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1"
                    placeholder="nombre completo ..." value="<?= $nombre ?>">
                <!-- error -->
                <span class="form-text text-danger" role="alert">
                    <?= $errores['nombre'] ??= null ?>
                </span>

            </div>
            <!-- fichero -->
            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione Archivo</label>
                <input class="form-control" type="file" name="fichero" id="formFile" accept="image/*"
                    value="<?= $fichero ?>">
                <!-- error -->
                <span class="form-text text-danger" role="alert">
                    <?= $errores['fichero'] ??= null ?>
                </span>
            </div>

            <!-- botones de acción -->
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>

    <?php require_once("template/partials/footer.php") ?>
    <?php require_once("template/partials/javascript.php") ?>
</body>

</html>