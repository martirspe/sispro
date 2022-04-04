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
	<title>Listado de Pagos - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
<div class="wrapper">
<?php require_once("inc/sidebar.php"); ?>

	<div class="main">
		<?php require_once("inc/navbar.php"); ?>

	<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Pagos</h1>
			<div class="row">
            <div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
								<div class="card-actions float-right">
									<div class="dropdown show">
										<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#">Option</a>
										</div>
									</div>
								</div>
									<h5 class="card-title">Detalle de los Pagos</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todos los pagos.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Imagen</th>
											<th>Nombre completo</th>
											<th>Cargo</th>
                                            <th>Adelantos</th>
                                            <th>Saldos</th>
                                            <th>Pago mensual</th>
                                            <th>Fecha de pago</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT
										EMP.EMP_imagen,
										EMP.EMP_nombres,
										EMP.EMP_apellidos,
										CAR.CAR_nombre,
										PAG.PAG_id,
										PAG.PAG_destajo,
										PAG.PAG_dia,
										PAG.PAG_semanal,
										PAG.PAG_adelantos,
										PAG.PAG_saldos,
										PAG.PAG_mensual,
										PAG.PAG_fecha,
										PAG.EMP_id
									FROM
										pagos PAG
									INNER JOIN empleados EMP ON
										PAG.EMP_id = EMP.EMP_id
									INNER JOIN cargos CAR ON
										CAR.CAR_id = EMP.CAR_id
									ORDER BY
										PAG.PAG_id ASC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results)>0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td>
													<img src="<?php echo $row['EMP_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['EMP_nombre'] ?>">
												</td>
												<td><?php echo $row['EMP_nombres'] ?> <?php echo $row['EMP_apellidos'] ?></td>
												<td><?php echo $row['CAR_nombre'] ?></td>
												<td>S/. <?php echo $row['PAG_adelantos'] ?></td>
												<td>S/. <?php echo $row['PAG_saldos'] ?></td>
												<td>S/. <?php echo $row['PAG_mensual'] ?></td>
												<td><?php echo $row['PAG_fecha'] ?></td>
												<td class="table-action">
													<a class="link-eye" href="#"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-order.php?id=<?php echo $row['ORD_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<a class="link-delete" href="#"><i class="align-middle" data-feather="trash"></i></a>
												</td>
											</tr>
											<?php }
										} else { ?>
											<td class="text-center" colspan="9"><i class="align-middle mr-1" data-feather="alert-circle"></i> No hay datos suficientes para mostrar. </td>
										<?php
										} ?>
                                    </tbody>
								</table>
							</div>
						</div>
            </div>
        </div>
	</main>
<?php require_once("inc/footer.php"); ?>