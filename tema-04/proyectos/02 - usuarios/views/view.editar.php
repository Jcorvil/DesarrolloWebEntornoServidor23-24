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

        <legend>Formulario Editar Libro</legend>

        <!-- Formulario Editar Libro -->
        <form action="update.php?indice=<?= $indice_editar ?>" method="POST">
            <!-- id oculto -->
            
                <!-- <label for="titulo" class="form-label">Id</label> -->
                <input type="hydeen" class="form-control" name="id" value="<?= $articulo['id'] ?>" hidden>
            
            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" value="<?= $articulo['descripcion'] ?>">
            </div>
            <!-- Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?= $articulo['modelo'] ?>">
                <!-- <div class="form-text">Introduzca Autor del libro</div> -->
            </div>
            
            <!-- Marca Select -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" aria-label="Default select example" name="marca">
                    <!-- Generar dinámicamente el parámetro selected en la etiqueta HTML option -->
                    <?php foreach ($marcas as $indice => $marca): ?>
                        <option value="<?= $indice ?>" <?= ($articulo['marca'] == $indice) ? 'selected' : null ?>>
                            <?= $marca ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Unidades -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="unidades" step="0.01"
                    value="<?= $articulo['unidades'] ?>">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>
            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $articulo['precio'] ?>">
                <!-- <div class="form-text">Introduzca Precio</div> -->
            </div>

            <!-- Categorías -->
            <div class="mb-3">
                <label for="categorias" class="form-label">Seleccione Categorías</label>
                <div class="form-control">
                    <?php foreach ($categorias as $indice => $categoria): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $indice ?>" name="categorias[]" 
                            <?= (in_array($indice, $articulo['categorias']) ? 'checked':null) ?> 
                            >
                            <label class="form-check-label" for="">
                                <?= $categoria ?>
                            </label>
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
        <?php include 'views/partials/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>