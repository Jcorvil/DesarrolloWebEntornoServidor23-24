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
            <i class="bi bi-book"></i>Tabla de Libros
            <span class="fs-6"></span>
        </header>

        <legend>Formulario nuevo libro</legend>

        <!--Formulario Nuevo libro-->
        <form method="POST" action="create.php">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="number" name="id" class="form-control">

            </div>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control">

            </div>
            <div class="mb-3">
                <labelclass="form-label">Autor</label>
                <input type="text" name="autor" class="form-control">

            </div>
            <div class="mb-3">
                <label class="form-label">Género</label>
                <input type="text" name="genero" class="form-control">

            </div>
            <div class="mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="any" name="precio" class="form-control">

            </div>
            <button type="submit" class="btn btn-primary">Añadir</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <a class="btn btn-secondary" role="button">Cancelar</a>
        </form>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>