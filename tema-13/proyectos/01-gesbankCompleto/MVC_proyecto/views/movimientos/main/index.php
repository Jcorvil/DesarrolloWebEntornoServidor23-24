<!doctype html>
<html lang="es">

<!-- head -->

<head>
    <?php require_once("template/partials/head.php") ?>
    <title>
        <?= $this->title ?>
    </title>
</head>

<body>
    <!-- Menú Principal -->
    <?php require_once("template/partials/menuAut.php") ?>
    <br><br><br>

    <!-- Page Content -->
    <div class="container">
        <!-- cabecera  -->
        <?php require_once("views/movimientos/partials/header.php") ?>

        <!-- mensajes -->
        <?php require_once("template/partials/notify.php") ?>

        <!-- errores -->
        <?php require_once("template/partials/error.php") ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                Tabla de movimientos
            </div>
            <div class="card-header">
                <!-- menu movimientos -->
                <?php require_once("views/movimientos/partials/menu.php") ?>
            </div>
            <div class="card-body">

                <!-- Muestra datos de la tabla -->
                <table class="table">
                    <!-- Encabezado tabla -->
                    <thead>
                        <tr>
                            <!-- personalizado -->
                            <th>Id</th>
                            <th>Nº Cuenta</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Tipo</th>
                            <th class="text-end">Cantidad</th>
                            <th class="text-end">Saldo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Mostramos cuerpo de la tabla -->
                    <tbody>

                        <!-- Objeto clase pdostatement en foreach -->
                        <?php foreach ($this->movimientos as $movimiento): ?>

                            <tr>
                                <!-- Formatos distintos para cada  columna -->

                                <!-- Detalles de movimientos -->
                                <td>
                                    <?= $movimiento->id ?>
                                </td>
                                <td>
                                    <?= $movimiento->num_cuenta ?>
                                </td>
                                <td>
                                    <?= $movimiento->fecha_hora ?>
                                </td>
                                <td>
                                    <?= $movimiento->concepto ?>
                                </td>
                                <td>
                                    <?= $movimiento->tipo ?>
                                </td>
                                <td class="text-end">
                                    <?= $movimiento->cantidad . ' €' ?>
                                </td>
                                <td class="text-end">
                                    <?= $movimiento->saldo . ' €' ?>
                                </td>

                                <!-- botones de acción -->
                                <td>

                                    <!-- botón mostrar -->
                                    <a href="<?= URL ?>movimientos/show/<?= $movimiento->id ?>" title="Mostrar"
                                        class="btn btn-warning <?= (!in_array($_SESSION['id_rol'], $GLOBALS['movimiento']['show'])) ? 'disabled' : '' ?>">
                                        <i class="bi bi-card-text"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>
            <div class="card-footer">
                <small class="text-muted"> Nº Movimientos:
                    <?= $this->movimientos->rowCount(); ?>
                </small>
            </div>
        </div>
    </div>
    <br><br><br>

    <!-- /.container -->

    <?php require_once("template/partials/footer.php") ?>
    <?php require_once("template/partials/javascript.php") ?>

</body>

</html>