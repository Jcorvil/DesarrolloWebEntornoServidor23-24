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
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Fecha Nacimiento</th>
                    <th>Edad</th></th>
                    <th>Curso</th>
                    <th>Asignaturas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Mostramos cuerpo de la tabla -->
            <tbody>

                <?php foreach ($alumnos->getAlumnos() as $indice => $alumno): ?>
                    <tr>
                        <!-- Mostramos la información de cada alumno en las celdas -->
                        <td>
                            <?= $alumno->id ?>
                        </td>
                        <td>
                            <?= $alumno->nombre ?>
                        </td>
                        <td>
                            <?= $alumno->apellidos ?>
                        </td>
                        <td>
                            <?= $alumno->email ?>
                        </td>
                        <td>
                            <?= $alumno->fecha_nacimiento ?>
                        </td>
                        <td>
                            <?= $alumno->getEdad() ?>
                        </td>
                        <td>
                            <?= $alumno->curso ?>
                        </td>
                        <td>
                            <?= implode(', ', ArrayAlumnos::mostrarAsignaturas(ArrayAlumnos::getAsignaturas(), $alumno->asignatura))?>
                        </td>
                        <td>
                            <!-- Acciones -->
                            <a href="eliminar.php?id=<?= $indice ?>" title="Eliminar"><i class="bi bi-trash"></i></a>
                            <a href="editar.php?id=<?= $indice ?>" title="Editar"><i class="bi bi-pencil"></i></a>
                            <a href="mostrar.php?id=<?= $indice ?>" title="Mostrar"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">Nº Alumnos
                        <?= count($alumnos->getTabla()) ?>
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