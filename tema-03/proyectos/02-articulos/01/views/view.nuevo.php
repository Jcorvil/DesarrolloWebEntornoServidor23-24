<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <!-- Incluir head -->
    <title>Tabla de articulos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-book"></i>Tabla de articulos
            <span class="fs-6"></span>
        </header>

        <legend>Formulario nuevo articulo</legend>

        <!--Formulario Nuevo libro-->
        <form method="POST" action="create.php">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="number" name="id" class="form-control" readonly>

            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control">

            </div>
            <div class="mb-3">
                <labelclass="form-label">Modelo</label>
                    <input type="text" name="modelo" class="form-control">

            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select type="text" name="categoria" class="form-select">
                    <option selected disabled>Seleccione una categoría</option>
                    <?php foreach ($categorias as $key => $categoria): ?>
                        <option value="<?= $key ?>">
                            <?= $categoria ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" name="unidades" class="form-control">

            </div>

            <div class="mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="any" name="precio" class="form-control">

            </div>
            <button type="submit" class="btn btn-primary">Añadir</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <a class="btn btn-secondary" role="button" href="index.php">Cancelar</a>
        </form>

        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>