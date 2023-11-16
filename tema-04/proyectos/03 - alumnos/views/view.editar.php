<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Información Alumnos</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Formulario Editar Alumnos</legend>

        <!-- Formulario Editar Libro -->
        <form action="update.php?indice=<?= $indice ?>" method="POST">
            <!-- id oculto -->

            <!-- <label for="titulo" class="form-label">Id</label> -->
            <input type="hydeen" class="form-control" name="id" value="<?= $alumno->id; ?>" hidden>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $alumno->nombre; ?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $alumno->apellidos; ?>">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?= $alumno->email; ?>">
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" name="fecha_nacimiento" value="<?= $alumno->fecha_nacimiento; ?>">
            </div>

            <!-- Curso -->
            <div class="mb-3">
                <label class="form-label">Seleccionar Curso</label>
                <div class="form-control">
                    <?php foreach ($cursos as $cursoIndice => $curso): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="<?= $cursoIndice ?>" name="cursos"
                                <?= (in_array($cursoIndice, (array) $alumno->curso) ? 'checked' : null) ?>>
                            <label class="form-check-label">
                                <?= $curso ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Asignaturas -->
            <div class="mb-3">
                <label class="form-label">Seleccionar Asignaturas</label>
                <div class="form-control">
                    <?php foreach ($asignaturas as $asignaturaIndice => $asignatura): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $asignaturaIndice ?>"
                                name="asignaturas[]" <?= (in_array($asignaturaIndice, $alumno->asignatura) ? 'checked' : null) ?>>
                            <label class="form-check-label">
                                <?= $asignatura ?>
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
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>