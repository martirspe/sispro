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
	<title>Listado de Categorías - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

		<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Categorías</h1>

					<div class="row">

					<div class="col-12 col-xl-12">
							<div class="card">
							
								<div class="card-header">
									<div class="card-actions float-right">
										<div class="dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="add-category.php">Añadir categoria</a>
											</div>
										</div>
									</div>
									<h5 class="card-title">Detalle de las Categorías</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todas las categorías.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>N°</th>
											<th>Imagen</th>
											<th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT LPAD(CAT_id, 4, '0') AS CAT_id, CAT_imagen, CAT_nombre, CAT_descripcion FROM categorias WHERE CAT_estado = 1 ORDER BY CAT_nombre ASC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results)>0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td><?php echo $row['CAT_id'] ?></td>
												<td>
													<img src="<?php echo $row['CAT_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['CAT_nombre'] ?>">
												</td>
												<td><?php echo $row['CAT_nombre'] ?></td>
												<td><?php echo $row['CAT_descripcion'] ?></td>
												<td class="table-action">
													<!-- BEGIN  modal -->
													<div class="modal fade" id="view-category" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">Ver categoría</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body m-3">
																	<div class="row">
																		<div class="col-md-4">
																			<img class="img-thumbnail rounded mr-2 mb-2" weight="300" height="300" src="<?php echo $row['CAT_imagen'] ?>" alt="<?php echo $row['CAT_nombre'] ?>">
																		</div>
																		<div class="col-md-8">
																			<h5>Categoría:</h5>
																			<p class="mb-3"><?php echo $row['CAT_nombre'] ?></p>
																			<h5>Descripción:</h5>
																			<p class="mb-0"><?php echo $row['CAT_descripcion'] ?></p>
																		</div>
																	</div>
																</div>
																<!-- <div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
																	<button type="button" class="btn btn-primary">Guardar cambios</button>
																</div> -->
															</div>
														</div>
													</div>
													<!-- END  modal -->
													<a class="link-eye" href="#" data-toggle="modal" data-target="#view-category"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-category.php?id=<?php echo $row['CAT_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<a class="link-delete" id="delete-category" href="#" data-id="<?php echo $row['CAT_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
												</td>
											</tr>
											<?php }
										} else { ?>
											<td class="text-center" colspan="5"><i class="align-middle mr-1" data-feather="alert-circle"></i> No hay datos suficientes para mostrar.</td>
										<?php
										} ?>
                                    </tbody>
								</table>
							</div>
							<div class="mt-3" id="success-delete-category"></div>
						</div>
            		</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>