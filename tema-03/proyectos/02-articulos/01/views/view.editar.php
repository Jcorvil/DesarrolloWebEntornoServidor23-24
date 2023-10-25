<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <!-- Incluir head -->
    <title>Tabla de artículos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-book"></i>Tabla de artículos
            <span class="fs-6"></span>
        </header>

        <legend>Formulario editar artículo</legend>

        <form method="POST" action="update.php?id=<?= $id ?>">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="number" name="id" class="form-control" value="<?= $articulo['id'] ?>" readonly />

            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="<?= $articulo['descripcion'] ?>"/>

            </div>
            <div class="mb-3">
                <label class="form-label">Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="<?= $articulo['modelo'] ?>"/>

            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select type="text" name="categoria" class="form-select">
                    <?php foreach ($categorias as $key => $categoria): ?>
                        <option value="<?= $key ?>"
                            <?= ($articulo['categoria'] == $key) ? 'selected' : null ?>
                        >
                            <?= $categoria ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Unidades</label>
                <input type="number" name="unidades" class="form-control" value="<?= $articulo['unidades'] ?>"/>

            </div>

            <div class="mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="any" name="precio" class="form-control" value="<?= $articulo['precio'] ?>"/>

            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <button type="reset" class="btn btn-danger">Restablecer</button>
            <a class="btn btn-secondary" role="button" href="index.php">Cancelar</a>
        </form>

        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>