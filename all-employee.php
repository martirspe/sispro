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
	<title>Listado de Empleados - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

		<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Empleados</h1>

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
								<div class="card-actions float-right">
									<div class="dropdown show">
										<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="add-employee.php">Añadir empleado</a>
										</div>
									</div>
								</div>
									<h5 class="card-title">Lista de empleados</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todos los empleados.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>N°</th>
											<th>Imagen</th>
											<th>Nombre completo</th>
                                            <th>Móvil</th>
                                            <th>Correo</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$query = "SELECT LPAD(EMP.EMP_id, 4, '0') AS EMP_id, EMP.EMP_imagen, EMP.EMP_dni, EMP.EMP_nombres, EMP.EMP_apellidos, EMP.EMP_movil, EMP.EMP_correo, EMP.EMP_genero, EMP.EMP_informacion, EMP.CAR_id, CAR.CAR_nombre FROM empleados EMP INNER JOIN cargos CAR ON EMP.CAR_id = CAR.CAR_id WHERE EMP.EMP_estado = 1 ORDER BY EMP_id DESC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results) > 0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td><?php echo $row['EMP_id'] ?></td>
                                                <td>
													<img src="<?php echo $row['EMP_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['EMP_nombres'] ?>">
												</td>
												<td><?php echo $row['EMP_nombres'] ?> <?php echo $row['EMP_apellidos'] ?></td>
												<td><?php echo $row['EMP_movil'] ?></td>
												<td><?php echo $row['EMP_correo'] ?></td>
												<td><?php echo $row['CAR_nombre'] ?></td>
												<td class="table-action">
													<a class="link-eye" href="#" data-toggle="modal" data-target="#view-employee"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-employee.php?id=<?php echo $row['EMP_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<a class="link-delete" id="delete-employee" href="#" data-id="<?php echo $row['EMP_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
												</td>
											</tr>
											<?php }
										} else { ?>
											<td class="text-center" colspan="6"><i class="align-middle mr-1" data-feather="alert-circle"></i> No hay datos suficientes para mostrar.</td>
										<?php
										} ?>
                                    </tbody>
								</table>
							</div>
							<div class="mt-3" id="success-delete-employee"></div>
						</div>
            		</div>
				</main>
			</div>
		</div>
<?php require_once("inc/footer.php"); ?>