<?php

include "inc/open-connection.php";
session_start();
if (empty($_SESSION['active'])) {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sistema para la gestión de Producción.">
	<meta name="author" content="MartiPE">
	<meta name="theme-color" content="#2979ff" />
	<title>Listado de Órdenes - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
<div class="wrapper">
<?php require_once("inc/sidebar.php"); ?>

	<div class="main">
		<?php require_once("inc/navbar.php"); ?>

	<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Órdenes</h1>
			<div class="row">
            <div class="col-12 col-xl-12">
			<div class="card">
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="add-order.php">Añadir orden</a>
											</div>
										</div>
									</div>
									<h5 class="card-title">Detalle de las Órdenes</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todas las órdenes.</h6>
								</div>
								<div class="card-body">
									<table id="datatables-basic" class="table table-striped" style="width:100%">
										<thead>
											<tr>
												<th class="not-actions">Imagen</th>
												<th>Modelo</th>
												<th>Color</th>
												<th>Tallas</th>
												<th>Cliente</th>
												<th>Fecha de orden</th>
												<th>Fecha de entrega</th>
												<th class="not-actions">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$query = "SELECT
											LPAD(ORD.ORD_id, 4, '0') AS ORD_id,
											CLI.CLI_nombres,
											CLI.CLI_apellidos,
											PRO.PRO_imagen,
											PRO.PRO_nombre,
											PRO.PRO_modelo,
											SER.SER_talla34,
											SER.SER_talla35,
											SER.SER_talla36,
											SER.SER_talla37,
											SER.SER_talla38,
											SER.SER_talla39,
											SER.SER_talla40,
											ORD.USU_id,
											ODET.ODET_material,
											ODET.ODET_suela,
											ODET.ODET_color,
											ODET.ODET_observacion,
											DATE_FORMAT(
												ODET.ODET_fecha,
												'%d de %M, %Y'
											) AS ODET_fecha,
											DATE_FORMAT(
												ODET.ODET_fechaEntrega,
												'%d de %M, %Y'
											) AS ODET_fechaEntrega
										FROM
											ordenes ORD
										INNER JOIN ordenes_detalles ODET ON
											ORD.ORD_id = ODET.ORD_id
										INNER JOIN productos PRO ON
											ODET.PRO_id = PRO.PRO_id
										INNER JOIN clientes CLI ON
											CLI.CLI_id = ORD.CLI_id
										INNER JOIN series SER ON
											SER.SER_id = ODET.SER_id
										WHERE
											ORD.ORD_estado = 1
										ORDER BY
											ORD.ORD_id
										DESC
											";
											$results = mysqli_query($open_connection, $query);
											if (mysqli_num_rows($results) > 0) {
												while ($row = mysqli_fetch_array($results)) { ?>
												<tr>
													<td>
														<img src="<?php echo $row['PRO_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['PRO_nombre'] ?>">
													</td>
													<td><?php echo $row['PRO_modelo'] ?></td>
													<td><?php echo $row['ODET_color'] ?></td>
													<?php
														$SER_talla34 = "";
														$SER_talla35 = "";
														$SER_talla36 = "";
														$SER_talla37 = "";
														$SER_talla38 = "";
														$SER_talla39 = "";
														$SER_talla40 = "";

														if ($row['SER_talla34'] > 0) {
															$SER_talla34 = "4";
														}
														if ($row['SER_talla35'] > 0) {
															$SER_talla35 = "5";
														}
														if ($row['SER_talla36'] > 0) {
															$SER_talla36 = "6";
														}
														if ($row['SER_talla37'] > 0) {
															$SER_talla37 = "7";
														}
														if ($row['SER_talla38'] > 0) {
															$SER_talla38 = "8";
														}
														if ($row['SER_talla39'] > 0) {
															$SER_talla39 = "9";
														}
														if ($row['SER_talla40'] > 0) {
															$SER_talla40 = "0";
														}

													?>
													<td><?php echo $SER_talla34 . ' ' . $SER_talla35 . ' ' . $SER_talla36 . ' ' . $SER_talla37 . ' ' . $SER_talla38 . ' ' . $SER_talla39 . ' ' . $SER_talla40 ?></td>
													<td><?php echo $row['CLI_nombres'] ?> <?php echo $row['CLI_apellidos'] ?></td>
													<td><?php echo $row['ODET_fecha'] ?></td>
													<td><?php echo $row['ODET_fechaEntrega'] ?></td>
													<td class="table-action">
														<a class="link-eye" href="order-details.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="eye"></i></a>
														<?php
														
														if ($_SESSION['USU_id'] == $row['USU_id']) { ?>
															<a class="link-change" href="change-process.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="settings"></i></a>
															<a class="link-edit" href="edit-order.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
															<a class="link-delete" id="delete-order" href="#" data-id="<?php echo $row['ORD_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
														<?php } else if($_SESSION['USU_tipo'] == 1) { ?>
															<a class="link-change" href="change-process.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="settings"></i></a>
															<a class="link-edit" href="edit-order.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
															<a class="link-delete" id="delete-order" href="#" data-id="<?php echo $row['ORD_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
														<?php }	?>
													</td>
												</tr>
												<?php }
											} else { ?>
												<td class="text-center" colspan="8"><i class="align-middle mr-1" data-feather="alert-circle"></i> No hay datos suficientes para mostrar. </td>
											<?php
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Imagen</th>
												<th>Modelo</th>
												<th>Color</th>
												<th>Tallas</th>
												<th>Cliente</th>
												<th>Fecha de orden</th>
												<th>Fecha de entrega</th>
												<th>Acciones</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>				
							<div class="mt-3" id="success-delete-order"></div>
						</div>
			</div>
			<script>
						document.addEventListener("DOMContentLoaded", function(event) {
							// Datatables basic
							$('#datatables-basic').DataTable({
								responsive: true
							});
							// Datatables with Buttons
							var datatablesButtons = $('#datatables-buttons').DataTable({
								lengthChange: !1,
								buttons: ["copy", "print"],
								responsive: true
							});
							datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
						});
			</script>
        </div>
	</main>
</div>
</div>
<?php require_once("inc/footer.php"); ?>