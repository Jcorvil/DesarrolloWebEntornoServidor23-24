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

        <legend>Formulario Mostrar Alumno</legend>

        <!-- Formulario Mostrar alumno -->
        <form>

            <div class="mb-3">
                <label class="form-label">id</label>
                <input type="number" class="form-control" name="id" value="<?= $alumno->id; ?>" disabled>
            </div>
            <!-- nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $alumno->nombre; ?>" disabled>
            </div>
            <!-- apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $alumno->apellidos ?>" disabled>
            </div>

            <!-- email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $alumno->email ?>" disabled>
            </div>

            <!-- fecha_nac -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="text" class="form-control" name="fecha_nacimiento" value="<?= $alumno->fecha_nacimiento ?>"
                    disabled>
            </div>

            <!-- curso -->
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="curso" disabled>
                    <?php foreach ($cursos as $key => $curso): ?>
                        <option value="<?= $key ?>" <?= ($alumno->curso == $key) ? 'selected' : null ?> disabled>
                            <?= $curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- asignaturas -->
            <!-- asignaturas -->
            <div class="mb-3">
                <label for="asignaturas" class="form-label">Asignaturas</label>
                <input type="text" class="form-control"
                    value="<?= implode(', ', ArrayAlumnos::mostrarAsignaturas($asignaturas, $alumno->asignatura)) ?> "
                    disabled>
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