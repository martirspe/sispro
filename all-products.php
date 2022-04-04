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
	<title>Listado de Productos - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

		<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Productos</h1>

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
								<div class="card-actions float-right">
									<div class="dropdown show">
										<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="add-product.php">Añadir producto</a>
										</div>
									</div>
								</div>
									<h5 class="card-title">Lista de productos</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todos los productos.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>N°</th>
											<th>Imagen</th>
                                            <th>Modelo</th>
                                            <th>Material</th>
                                            <th>Suela</th>
                                            <th>Color</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$query = "SELECT LPAD(PRO_id, 4, '0') AS PRO_id, PRO_imagen, PRO_nombre, PRO_marca, PRO_modelo, PRO_material, PRO_suela, PRO_color, PRO_precio FROM productos WHERE PRO_estado = 1 ORDER BY PRO_id DESC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results) > 0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td><?php echo $row['PRO_id'] ?></td>
                                                <td>
													<img src="<?php echo $row['PRO_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['PRO_nombre'] ?>">
												</td>
												<td><?php echo $row['PRO_modelo'] ?></td>
												<td><?php echo $row['PRO_material'] ?></td>
												<td><?php echo $row['PRO_suela'] ?></td>
												<td><?php echo $row['PRO_color'] ?></td>
												<td><?php echo $row['PRO_precio'] ?></td>
												<td class="table-action">
													<a class="link-eye" href="#" data-toggle="modal" data-target="#view-product"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-product.php?id=<?php echo $row['PRO_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<a class="link-delete" id="delete-product" href="#" data-id="<?php echo $row['PRO_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
												</td>
											</tr>
											<?php }
										} else { ?>
											<td class="text-center" colspan="8"><i class="align-middle mr-1" data-feather="alert-circle"></i> No hay datos suficientes para mostrar.</td>
										<?php
										} ?>
                                    </tbody>
								</table>
							</div>
							<div class="mt-3" id="success-delete-product"></div>
						</div>
            		</div>
				</main>
			</div>
		</div>
<?php require_once("inc/footer.php"); ?>