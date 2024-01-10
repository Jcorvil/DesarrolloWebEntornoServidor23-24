<?php

// Iniciamos la sesión
session_start();

$visitasTotales = 0;

if (isset($_SESSION['num_visitas_home'])) {
  $visitasTotales += $_SESSION['num_visitas_home'];
}
if (isset($_SESSION['num_visitas_about'])) {
  $visitasTotales += $_SESSION['num_visitas_about'];
}
if (isset($_SESSION['num_visitas_servicios'])) {
  $visitasTotales += $_SESSION['num_visitas_servicios'];
}
if (isset($_SESSION['num_visitas_eventos'])) {
  $visitasTotales += $_SESSION['num_visitas_eventos'];
}


if (!isset($_SESSION['fecha_hora_visita'])) {
  $_SESSION['fecha_hora_visita'] = time();
}

if (!isset($_SESSION['fecha_hora_fin'])) {
  $_SESSION['fecha_hora_fin'] = time();
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
    <li>Página: Cerrar</li>
    <li>SID:
      <?= session_id() ?>
    </li>
    <li>Nombre sesión:
      <?= session_name() ?>
    </li>
    <li>Fecha inicio sesión:
      <?= date('d-m-Y H:i:s', $_SESSION['fecha_hora_visita']) ?>
    </li>
    <li>Fecha fin sesión:
      <?= date('d-m-Y H:i:s', $_SESSION['fecha_hora_fin']) ?>
    </li>
    <li>Visitas totales:
      <?= $visitasTotales ?>
    </li>
    <?= session_destroy(); ?>
  </ul>

</body>

</html>