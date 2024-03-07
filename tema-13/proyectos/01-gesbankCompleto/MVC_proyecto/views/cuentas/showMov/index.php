<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php") ?>
    <title>
        Movimientos
    </title>
</head>

<body>
    <?php require_once("template/partials/menuAut.php") ?>
    <br><br><br>

    <div class="container">
        <?php require_once("views/cuentas/partials/header.php") ?>
        <?php require_once("template/partials/notify.php") ?>
        <?php require_once("template/partials/error.php") ?>

        <div class="card">
            <div class="card-header">
                Movimientos de la cuenta
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nº Cuenta</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Tipo</th>
                            <th class="text-end">Cantidad</th>
                            <th class="text-end">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->movimientos as $movimiento): ?>
                            <tr>
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
                                    <?php
                                    if ($movimiento->tipo == 'R') {
                                        echo '- ' . $movimiento->cantidad . ' €';
                                    } else {
                                        echo $movimiento->cantidad . ' €';
                                    }
                                    ?>
                                </td>
                                <td class="text-end">
                                    <?= $movimiento->saldo . ' €' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <small class="text-muted"> Nº Movimientos:
                    <?= count($this->movimientos) ?>
                </small>
            </div>
        </div>
    </div>
    <br><br><br>

    <?php require_once("template/partials/footer.php") ?>
    <?php require_once("template/partials/javascript.php") ?>

</body>

</html>