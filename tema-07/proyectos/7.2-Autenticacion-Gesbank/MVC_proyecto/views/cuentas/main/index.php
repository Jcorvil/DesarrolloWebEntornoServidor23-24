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
	<?php require_once("template/partials/menu.php") ?>
	<br><br><br>

	<!-- Page Content -->
	<div class="container">
		<!-- cabecera  -->
		<?php require_once("views/cuentas/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>



		<!-- Estilo card de bootstrap -->
		<div class="card">
			<div class="card-header">
				Tabla de Cuentas
			</div>
			<div class="card-header">
				<!-- menu Cuentas -->
				<?php require_once("views/cuentas/partials/menu.php") ?>
			</div>
			<div class="card-body">

				<!-- Muestra datos de la tabla -->
				<table class="table">
					<!-- Encabezado tabla -->
					<thead>
						<tr>
							<!-- personalizado -->
							<th>Id</th>
							<th>Nº de cuenta</th>
							<th>Cliente</th>
							<th>Fecha Alta</th>
							<th>Fecha último movimiento</th>
							<th>Movimientos Totales</th>
							<th>Saldo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<!-- Mostramos cuerpo de la tabla -->
					<tbody>

						<!-- Objeto clase pdostatement en foreach -->
						<?php foreach ($this->cuentas as $cuenta): ?>
							<tr>
								<!-- Formatos distintos para cada  columna -->

								<!-- Detalles de cuentas -->
								<td>
									<?= $cuenta->id ?>
								</td>
								<td>
									<?= $cuenta->num_cuenta ?>
								</td>
								<td>
									<?= $cuenta->cliente ?>
								</td>
								<td>
									<?= $cuenta->fecha_alta ?>
								</td>
								<td>
									<?= $cuenta->fecha_ul_mov ?>
								</td>
								<td class="text-end">
									<?= number_format($cuenta->num_movtos, 0, ',', '.') ?>
								</td>
								<td class="text-end">
									<?= number_format($cuenta->saldo, 2, ',', '.') ?>
								</td>
								<!-- botones de acción -->
								<td>

									<!-- botón eliminar -->
									<a href="<?= URL ?>cuentas/delete/<?= $cuenta->id ?>" title="Eliminar"
										onclick="return confirm('Confirme la eliminación de la cuenta')">
										<i class="bi bi-trash-fill"></i>
									</a>

									<!-- botón editar -->
									<a href="<?= URL ?>cuentas/edit/<?= $cuenta->id ?>" title="Editar">
										<i class="bi bi-pencil-square"></i></a>

									<!-- botón mostrar -->
									<a href="<?= URL ?>cuentas/show/<?= $cuenta->id ?> ?>" title="Mostrar">
										<i class="bi bi-card-text"></i></a>

								</td>
							</tr>

						<?php endforeach; ?>


					</tbody>

				</table>

			</div>
			<div class="card-footer">
				<small class="text-muted"> Nº cuentas:
					<?= $this->cuentas->rowCount(); ?>
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