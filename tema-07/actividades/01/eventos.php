<?php

// Iniciamos la sesión
session_start();

if (isset($_SESSION['num_visitas_eventos'])) {
  $_SESSION['num_visitas_eventos']++;
} else {
  $_SESSION['num_visitas_eventos'] = 1;
}

if (!isset($_SESSION['fecha_hora_visita'])) {
  $_SESSION['fecha_hora_visita'] = time();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <ul>
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="about.php">A cerca de</a>
    </li>
    <li>
      <a href="servicios.php">Servicios</a>
    </li>
    <li>
      <a href="eventos.php">Eventos</a>
    </li>
    <li>
      <a href="cerrar.php">Cerrar</a>
    </li>
  </ul>

  <h3>Detalles</h3>
  <ul>
    <li>Página: Eventos</li>
    <li>SID:
      <?= session_id() ?>
    </li>
    <li>Nombre sesión:
      <?= session_name() ?>
    </li>
    <li>Fecha inicio sesión:
      <?= date('d-m-Y H:i:s', $_SESSION['fecha_hora_visita']) ?>
    </li>
    <li>Visitas durante la sesión:
      <?= $_SESSION['num_visitas_eventos'] ?>
    </li>
  </ul>

</body>

</html>