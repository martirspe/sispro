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
	<title>Listado de Usuarios - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
<div class="wrapper">
<?php require_once("inc/sidebar.php"); ?>

	<div class="main">
		<?php require_once("inc/navbar.php"); ?>

	<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Usuarios</h1>
			<div class="row">
            <div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
								<div class="card-actions float-right">
									<div class="dropdown show">
										<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="add-user.php">Añadir usuario</a>
										</div>
									</div>
								</div>
									<h5 class="card-title">Lista de usuarios</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todos los usuarios.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>N°</th>
											<th>Imagen</th>
											<th>Nombre completo</th>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>Móvil</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT LPAD(USU_id, 4, '0') AS USU_id, USU_imagen, USU_usuario, USU_nombres, USU_apellidos, USU_movil, USU_correo, USU_tipo, USU_fechaCreacion FROM usuarios WHERE USU_estado = 1 ORDER BY USU_id DESC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results)>0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td><?php echo $row['USU_id'] ?></td>
                                                <td>
													<img src="<?php echo $row['USU_imagen'] ?>" width="48" height="48" class="rounded-circle mr-2" alt="<?php echo $row['USU_nombres'] ?>">
												</td>
												<td><?php echo $row['USU_nombres'] ?> <?php echo $row['USU_apellidos'] ?></td>
												<td><?php echo $row['USU_usuario'] ?></td>
												<td><?php echo $row['USU_correo'] ?></td>
												<td><?php echo $row['USU_movil'] ?></td>
												<td class="table-action">
													<!-- BEGIN  modal -->
													<div class="modal fade" id="view-user" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">Detalles del usuario</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body m-3">
																	<div class="row">
																		<div class="col-md-4">
																			<img class="img-thumbnail rounded mr-2 mb-2" weight="300" height="300" src="<?php echo $row['USU_imagen'] ?>" alt="<?php echo $row['USU_nombres'] ?>">
																		</div>
																		<div class="col-md-8">
																			<h5>Nombre:</h5>
																			<p class="mb-2"><?php echo $row['USU_nombres'] ?> <?php echo $row['USU_apellidos'] ?></p>
																			<h5>Móvil:</h5>
																			<p class="mb-2"><?php echo $row['USU_movil'] ?></p>
																			<div class="row">
																				<div class="col">
																					<h5>Usuario:</h5>
																					<p class="mb-2"><?php echo $row['USU_usuario'] ?></p>
																				</div>
																				<div class="col">
																					<h5>Correo:</h5>
																					<p class="mb-2"><?php echo $row['USU_correo'] ?></p>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col">
																					<h5>Tipo de usuario:</h5>
																					<p class="mb-2"><?php 
																						
																						if ($row['USU_tipo'==1]) {
																							echo "Administrador";
																						} else {
																							echo "Usuario";
																						}

																					?></p>
																				</div>
																				<div class="col">
																					<h5>Fecha de creación:</h5>
																					<p class="mb-0"><?php echo $row['USU_fechaCreacion'] ?></p>
																				</div>
																			</div>
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
													<a class="link-eye" href="#" data-toggle="modal" data-target="#view-user"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-user.php?id=<?php echo $row['USU_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<?php
														if ($row['USU_tipo'] != 1) { ?>
															<a class="link-delete" id="delete-user" href="#" data-id="<?php echo $row['USU_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
													<?php } ?>
													
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
							<div class="mt-3" id="success-delete-user"></div>
						</div>
            </div>
        </div>
	</main>
<?php require_once("inc/footer.php"); ?>