<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluir head -->
    <title>Conversor</title>
    <?php include 'views/layouts/head.html' ?>
</head>
<body>
    <!-- Capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator">Calculadora Conversor Decimal</i>
            <span class="fs-6"></span>   
        </header>

        <legend>Formulario  Conversor</legend>
        <form method="POST" action="conversor.php">

            <!-- Valor Decimal -->
            <div class="form-group">
                <label>Valor Decimal:</label>
                <input type="number" name="valorDecimal" class="form-control" placeholder="0" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Introduzca un número en decimal</small>
            </div>

            <br>
            
            <!-- Botones de acción -->
            <button type="reset" class="btn btn-secondary">Borrar</button>

            <div class="btn-group" role="group" >
                <button type="submit" class="btn btn-warning" formaction="binario.php">Binario</button>
                <button type="submit" class="btn btn-success" formaction="octal.php">Octal</button>
                <button type="submit" class="btn btn-danger" formaction="hexadecimal.php">Hexadecimal</button>
            </div>

            <button type="submit" class="btn btn-primary" formaction="conversor.php">Todas</button>

            
            
        </form>

        
        <!-- Pié del documento -->
        <?php include 'views/layouts/footer.html' ?>
        
    </div>

    <!-- javascript bootstrap 532 -->
    <?php include 'views/layouts/javascript.html' ?>
</body>
</html>