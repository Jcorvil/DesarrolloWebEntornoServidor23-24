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
		<?php require_once("views/cuentas/partials/header.php") ?>

		<!-- mensajes -->
		<?php require_once("template/partials/notify.php") ?>

		<!-- errores -->
		<?php require_once("template/partials/error.php") ?>

		<!-- Modal -->
		<?php require('template/partials/modalCuentas.php'); ?>


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
							<th>cuenta</th>
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
										class="btn btn-danger <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['delete'])) ? 'disabled' : '' ?>"
										onclick="return confirm('Confirmar eliminación del cuenta')">
										<i class="bi bi-trash"></i>
									</a>

									<!-- botón editar -->
									<a href="<?= URL ?>cuentas/edit/<?= $cuenta->id ?>" title="Editar"
										class="btn btn-primary <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['edit'])) ? 'disabled' : '' ?>">
										<i class="bi bi-pencil"></i>
									</a>

									<!-- botón mostrar -->
									<a href="<?= URL ?>cuentas/show/<?= $cuenta->id ?>" title="Mostrar"
										class="btn btn-warning <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['show'])) ? 'disabled' : '' ?>">
										<i class="bi bi-card-text"></i>
									</a>

									<!-- botón mostrar movimientos -->
									<a href="<?= URL ?>cuentas/showMov/<?= $cuenta->id ?>" title="Mostrar Movimientos"
										class="btn btn-success <?= (!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['showMov'])) ? 'disabled' : '' ?>">
										<i class="bi bi-list-ol"></i>
									</a>
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