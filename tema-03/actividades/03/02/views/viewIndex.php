<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/head.html' ?>
    <!-- Incluir head -->
    <title>Tabla de multiplicar</title>
</head>

<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calendar-date"></i></i>Tabla de multiplicar
            <span class="fs-6"></span>
        </header>

        <legend>Tabla de multiplicar</legend>


        <table class="table table-primary">
            <tbody>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <tr>
                        <?php for ($j = 1; $j <= 10; $j++): ?>
                            <td>
                                <?= ($i * $j) ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>

    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>

</html>