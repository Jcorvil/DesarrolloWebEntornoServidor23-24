<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 5.1 CRUD - Tabla Corredores de la BBDD Maratoon</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Tabla Corredores</legend>

        <!-- Notificación -->
        <?php include 'views/partials/notificacion.php' ?>

        <!-- Muestra datos de la tabla -->
        <form action="create.php" method="POST">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>">
            </div>
            <!-- Ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad?>">
            </div>
            <!-- Sexo -->
            <div class="mb-3">
                <label class="form-label">Sexo</label>
                <div class="form-control">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value="H" checked>
                        <label class="form-check-label">Hombre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value="M">
                        <label class="form-check-label">Mujer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" value="">
                        <label class="form-check-label">Sin Especificar</label>
                    </div>
                </div>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" value="<?= $corredor->fechaNacimiento ?>">
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>">
            </div>
            <!-- DNI -->
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>">
            </div>
            <!-- Categoria -->
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria</label>
                <select class="form-select" aria-label="Default select example" name="id_categoria">
                    <option selected disabled>Seleccione categoría</option>
                    <?php foreach($categorias as $categoria): ?>
                        <option value="<?= $categoria->id ?>">
                            <?= $categoria->nombrecorto ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Club -->
            <div class="mb-3">
                <label for="id_club" class="form-label">Club</label>
                <select class="form-select" aria-label="Default select example" name="id_club">
                    <option selected disabled>Seleccione club</option>
                    <?php foreach($clubs as $club): ?>
                        <option value="<?= $club->id ?>">
                            <?= $club->nombrecorto ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>

            <br>
            <br>
            <br>

        </form>

        <?php $conexion->cerrar_conexion();
        $alumnos = null; ?>



        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>