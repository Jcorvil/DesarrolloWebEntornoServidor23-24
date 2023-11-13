<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Proyecto 4.2 - Gestión Artículos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Formulario Editar Articulo</legend>

        <!-- Formulario Editar Libro -->
        <form action="update.php?indice=<?= $indice ?>" method="POST">
            <!-- id oculto -->
            
                <!-- <label for="titulo" class="form-label">Id</label> -->
                <input type="hydeen" class="form-control" name="id" value="<?= $articulo->getId(); ?>" hidden>
            
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $articulo->getDescripcion(); ?>">
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $articulo->getModelo(); ?>">
                <!-- <div class="form-text">Introduzca Autor del libro</div> -->
            </div>
            
            <!-- Marca Select -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" aria-label="Default select example" name="marca">
                    <!-- Generar dinámicamente el parámetro selected en la etiqueta HTML option -->
                    <?php foreach ($marcas as $indice => $marca): ?>
                        <option value="<?= $indice ?>" <?= ($articulo->getMarca() == $indice) ? 'selected' : null ?>>
                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Unidades -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades" step="0.01"
                    value="<?= $articulo->getUnidades(); ?>">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo->getPrecio(); ?>">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>

            <!-- Categorías -->
            <div class="mb-3">
                <label class="form-label">Seleccionar Categorías</label>
                <div class="form-control">
                    <?php foreach ($categorias as $indice => $categoria) : ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]" <?= (in_array($indice, $articulo->getCategoria()) ? 'checked' : null) ?>>
                            <label class="form-check-label" for="">
                                <?= $categoria ?>
                                <label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Restablecer</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

        </form>

        <br>
        <br>
        <br>




        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>