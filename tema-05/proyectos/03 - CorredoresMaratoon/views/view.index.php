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

        <!-- Menu Principal -->
        <?php include 'views/partials/menu_prin.php' ?>

        <!-- Notificación -->
        <?php include 'views/partials/notificacion.php' ?>

        <!-- Muestra datos de la tabla -->
        <table class="table">
            <!-- Encabezado tabla -->
            <thead>
                <tr>
                    <!-- personalizado -->
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Ciudad</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Categoría</th>
                    <th>Club</th>
                </tr>
            </thead>
            <!-- Mostramos cuerpo de la tabla -->
            <tbody>

                <!-- Objeto mysqli_result puede ser asignado a foreach -->
                <?php foreach($corredores as $corredor): ?>
                    <tr>
                        <!-- Formatos distintos para cada  columna -->

                        <!-- Detalles de corredores -->
                        <td>
                            <?= $corredor->id ?>
                        </td>
                        <td>
                            <?= $corredor->nombre ?>
                        </td>
                        <td>
                            <?= $corredor->apellidos ?>
                        </td>
                        <td>
                            <?= $corredor->ciudad ?>
                        </td>
                        <td>
                            <?= $corredor->email ?>
                        </td>
                        <td>
                            <?= $corredor->edad ?>
                        </td>
                        <td>
                            <?= $corredor->categoria ?>
                        </td>
                        <td>
                            <?= $corredor->club ?>
                        </td>

                        <!-- botones de acción -->
                        <td>
                            <!-- botón eliminar -->
                            <a href="delete.php?id=<?= $corredor->id ?>" title="Eliminar"
                                onclick="return confirmarEliminar()">
                                <i class="bi bi-trash-fill"></i></a>

                            <!-- botón  editar -->
                            <a href="editar.php?id=<?= $corredor->id ?>" title="Editar">
                                <i class="bi bi-pencil-square"></i></a>

                            <!-- botón  mostrar -->
                            <a href="view.php?id=<?= $corredor->id ?> ?>" title="Mostrar">
                                <i class="bi bi-card-text"></i></a>

                        </td>
                    </tr>

                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Nº corredores
                        <?php
                        if($corredores instanceof PDOStatement) {
                            echo $corredores->rowCount();
                        } else {
                            echo count($corredores);
                        }
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>

        <br>
        <br>
        <br>
        <br>

        <?php $conexion->cerrar_conexion();
        $alumnos = null; ?>



        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>