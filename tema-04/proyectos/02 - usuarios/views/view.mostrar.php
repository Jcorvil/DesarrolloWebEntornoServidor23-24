<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Proyecto 3.1 - Gestión de libros</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Formulario Mostrar Artículo</legend>

        <!-- Formulario Mostrar Artículo -->
        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $articulo['id'] ?>" disabled>
            </div>
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $articulo['descripcion'] ?>"
                    disabled>
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $articulo['modelo'] ?>" disabled>
            </div>
            <!-- Marca Select -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" name="categoria"
                    value="<?= $marcas[$articulo['marca']] ?>" disabled>
            </div>
            <!-- Unidades -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades" step="0.01"
                    value="<?= $articulo['unidades'] ?>" disabled>
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['precio'] ?>"
                    disabled>
            </div>

             <!-- Categorías -->
             <div class="mb-3">
                <label for="marca" class="form-label">Categorías</label>
                <input type="text" class="form-control" name="categorias"
                    value="<?= implode(', ', mostrarCategorias($categorias, $articulo['categorias'])) ?>" disabled>
            </div>


            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Volver</a>

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