<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <title>Proyecto 5.1 CRUD - Tabla Corredores de la BBDD Maratoon</title>

    <script>
        function confirmarEliminar() {

            var confirmacion = confirm("¿Estás seguro de que quieres eliminar al corredor?");

            return confirmacion;
        }
    </script>
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

            <!-- ID -->
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" value="<?=$corredor->id?>" disabled>
            </div>
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?=$corredor->nombre?>" disabled>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" value="<?=$corredor->apellidos?>" disabled>
            </div>
            <!-- Ciudad -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" value="<?=$corredor->ciudad?>" disabled>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="<?=$corredor->email?>" disabled>
            </div>
            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" value="<?=$corredor->fechaNacimiento?>" disabled>
            </div>
            <!-- Categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" value="<?=$categoria->nombre?>" disabled>
            </div>

            <!-- Club -->
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <input type="text" class="form-control" value="<?=$club->nombre?>" disabled>
            </div>

            <!-- botones de acción -->
            <div class="mb-3">
                <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
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