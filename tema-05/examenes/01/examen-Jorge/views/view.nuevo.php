<!DOCTYPE html>
<html lang="es">

<head>
    <!-- layout.head -->
    <?php include('views/layouts/layout.head.html'); ?>

    <title>Nuevo - Gestión Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">
        <!-- partial.header -->
        <legend>Formulario Nuevo Libro</legend>

        <form action="create.php" method="POST">
            <!-- título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo">
            </div>

            <!-- isbn -->
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" name="isbn">
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha de edición</label>
                <input type="date" class="form-control" name="fecha_edicion">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="autores" class="form-label">Autor</label>
                <select class="form-select" name="autor_id">
                    <option selected disabled>Seleccione Autor</option>
                    <?php foreach ($autores as $autor): ?>
                        <option value="<?= $autor->id ?>">
                            <?= $autor->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="editoriales" class="form-label">Editorial</label>
                <select class="form-select" name="editorial_id">
                    <option selected disabled>Seleccione Editorial</option>
                    <?php foreach ($editoriales as $editorial): ?>
                        <option value="<?= $editorial->id ?>">
                            <?= $editorial->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- stock -->
            <div class="mb-3">
                <label for="stock" class="form-label">Unidades</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" value=0 name="stock">
            </div>

            <!-- precio_coste -->
            <div class="mb-3">
                <label for="precio_coste" class="form-label">Precio Coste</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" value=0.00 name="precio_coste">
            </div>

            <!-- precio_venta -->
            <div class="mb-3">
                <label for="precio_venta" class="form-label">Precio Venta</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" value=0.00 name="precio_venta">
            </div>


            <!-- Botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br><br><br>

        <!-- partial.footer -->
        <?php include('views/partials/partial.footer.html'); ?>

        <!-- layout.javascript -->
        <?php include("layouts/layout.javascript.html"); ?>

</body>

</html>