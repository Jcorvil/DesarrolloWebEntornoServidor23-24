<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once('template/partials/head.php') ?>
    <title>
        <?= $this->title ?>
    </title>
</head>

<body>
    <?php require_once("template/partials/menu.php") ?>
    <br>
    <br>
    <br>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php require_once('template/partials/header.php') ?>

        <legend>Formulario Editar Alumnos</legend>

        <!-- Formulario Nuevo Alumno -->
        <form action="<?= URL ?>alumno/update/<?= $this->id ?>" method="POST">

            <!-- id oculta-->
            <input type="number" class="form-control" name="id" value="<?= $this->$alumno->id ?>" hidden>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $this->$alumno->nombre ?>">
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $this->$alumno->apellidos ?>">
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNac" value="<?= $this->$alumno->fechaNac ?>">
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $this->$alumno->dni ?>">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $this->$alumno->email ?>">
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" value="<?= $this->$alumno->telefono ?>">
            </div>
            <!-- Dirección -->
            <!-- <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?= $this->$alumno->direccion ?>">
            </div> -->
            <!-- Población -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion" value="<?= $this->$alumno->poblacion ?>">
            </div>
            <!-- Provincia -->
            <!-- <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?= $this->$alumno->provincia ?>">
            </div> -->
            <!-- Nacionalidad -->
            <!-- <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" value="<?= $this->$alumno->nacionalidad ?>">
            </div> -->
            <!-- Curso Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="id_curso">
                    <?php foreach ($this->cursos as $data): ?>
                        <option value="<?= $data->id ?>"
                            <?=($this->alumno->id_curso == $data->id)? 'selected': null?>
                        >
                            <?= $data->curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Restaurar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>




        <!-- Pié del documento -->
        <?php require_once('template/partials/footer.php') ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php require_once('template/partials/javascript.php') ?>
</body>

</html>