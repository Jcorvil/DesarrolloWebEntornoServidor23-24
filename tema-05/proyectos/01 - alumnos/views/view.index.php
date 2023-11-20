<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.php' ?>
    <title>Proyecto 5.1 - Alumnos FP</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <legend>Tabla Alumnos</legend>

        <!-- Menu Principal -->
        <?php include 'views/partials/menu_prin.php' ?>

        <br>
        <!-- Notificación -->
        <?php include 'views/partials/notificacion.php' ?>

        <!-- Muestra datos de la tabla -->
        <table class="table">
            <!-- Encabezado tabla -->
            <thead>
                <tr>
                    <!-- personalizado -->
                    <th>Id</th>
                    <th>Alumno</th>
                    <th>Edad</th>
                    <th>Dni</th>
                    <th>Poblacion</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <!-- Mostramos cuerpo de la tabla -->
            <tbody>

                <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <!-- Formatos distintos para cada  columna -->

                        <!-- Detalles de artículos -->
                        <td>
                            <?= $alumno['id'] ?>
                        </td>
                        <td>
                            <?= $alumno['alumno'] ?>
                        </td>
                        <td class="text-end">
                            <?= $alumno['edad'] ?>
                        </td>
                        <td>
                            <?= $alumno['dni'] ?>
                        </td>
                        <td>
                            <?= $alumno['poblacion'] ?>
                        </td>
                        <td>
                            <?= $alumno['email'] ?>
                        </td>
                        <td>
                            <?= $alumno['telefono'] ?>
                        </td>
                        <td>
                            <?= $alumno['curso'] ?>
                        </td>


                        <td>
                            <a href="eliminar.php?id=<?= $alumno ?>" title="Eliminar"><i class="bi bi-trash"></i></a>
                            <a href="editar.php?id=<?= $alumno ?>" title="Editar"><i class="bi bi-pencil"></i></a>
                            <a href="mostrar.php?id=<?= $alumno ?>" title="Mostrar"><i class="bi bi-eye"></i></a>

                        </td>
                    </tr>

                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">Nº Alumnos
                        <?= $alumnos->num_rows ?>
                    </td>
                </tr>
            </tfoot>
        </table>



        <!-- Pié del documento -->
        <?php include 'views/partials/footer.php' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.php' ?>
</body>

</html>