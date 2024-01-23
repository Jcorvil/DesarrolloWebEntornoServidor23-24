<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php") ?>
    <title><?= $this->title ?></title>
</head>

<body>
    <!-- Menú Principal -->
	<?php require_once("template/partials/menuAut.php") ?>
	<br><br><br>

    <!-- Capa principal -->
    <div class="container">

        <!-- header -->
        <?php include 'views/alumno/partials/header.php' ?>

        <!-- comprobamos si existe error -->
        <?php include 'template/partials/error.php' ?>

        <legend>Formulario Nuevo Alumno</legend>

        

        <!-- Formulario Nuevo Libro -->
        <form action="<?= URL ?>alumno/create" method="POST">

            <!-- id -->
            <!-- <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>  -->
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?=$this->alumno->nombre ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['nombre'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['nombre'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?=$this->alumno->apellidos ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['apellidos'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['apellidos'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fechaNac" value="<?=$this->alumno->fechaNac ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['fechaNac'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['fechaNac'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?=$this->alumno->dni ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['dni'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['dni'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?=$this->alumno->email ?>">
                 <!-- Mostrar posible error -->
                 <?php if(isset($this->errores['email'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" value="<?=$this->alumno->telefono ?>">
            </div>
            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?=$this->alumno->direccion ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['direccion'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['direccion'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Población -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" name="poblacion" value="<?=$this->alumno->poblacion ?>">
            </div>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?=$this->alumno->provincia ?>">
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['provincia'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['provincia'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Nacionalidad -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" value="<?=$this->alumno->nacionalidad ?>">
            </div>
            <!-- Curso Select -->
            <div class="mb-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-select" aria-label="Default select example" name="id_curso">
                    <option selected disabled>Seleccione Curso</option>
                    <?php foreach ($this->cursos as $data): ?>
                        <option value="<?= $data->id ?>"
                            <?= ($this->alumno->id_curso == $data->id)? 'selected': null ?>
                        >
                            <?= $data->curso ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <!-- Mostrar posible error -->
                <?php if(isset($this->errores['id_curso'])): ?>
                    <span class="form-text text-danger" role="alert">
                            <?= $this->errores['id_curso'] ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br>
        <br>
        <br>




        <!-- Pié del documento -->
        <?php include 'template/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'template/partials/javascript.php' ?>
</body>

</html>