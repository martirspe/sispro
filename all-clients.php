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
	<title>Listado de Clientes - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
<div class="wrapper">
<?php require_once("inc/sidebar.php"); ?>

	<div class="main">
		<?php require_once("inc/navbar.php"); ?>

	<main class="content">
		<div class="container-fluid p-0">
			<h1 class="h3 mb-3">Clientes</h1>
			<div class="row">
            <div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
								<div class="card-actions float-right">
									<div class="dropdown show">
										<a href="#" data-toggle="dropdown" data-display="static"><i class="align-middle" data-feather="more-horizontal"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="add-client.php">Añadir cliente</a>
										</div>
									</div>
								</div>
									<h5 class="card-title">Lista de clientes</h5>
									<h6 class="card-subtitle text-muted">A continuación se muestra el detalle completo de todos los clientes.</h6>
								</div>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>N°</th>
											<th>DNI</th>
											<th>Nombre completo</th>
                                            <th>Móvil</th>
                                            <th>Correo</th>
                                            <th>Dirección</th>
                                            <th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = "SELECT LPAD(CLI_id, 4, '0') AS CLI_id, CLI_dni, CLI_genero, CLI_nombres, CLI_apellidos, CLI_movil, CLI_correo, CLI_direccion, CLI_observacion, CLI_fechaCreacion, CLI_estado FROM clientes WHERE CLI_estado >= 1 ORDER BY CLI_nombres DESC";
										$results = mysqli_query($open_connection, $query);
										if (mysqli_num_rows($results)>0) {
											while ($row = mysqli_fetch_array($results)) { ?>
											<tr>
												<td><?php echo $row['CLI_id'] ?></td>
												<td><?php echo $row['CLI_dni'] ?></td>
												<td><?php echo $row['CLI_nombres'] ?> <?php echo $row['CLI_apellidos'] ?></td>
												<td><?php echo $row['CLI_movil'] ?></td>
												<td><?php echo $row['CLI_correo'] ?></td>
												<td><?php echo $row['CLI_direccion'] ?></td>
												<td class="table-action">
													<!-- BEGIN  modal -->
													<div class="modal fade" id="view-client" tabindex="-1" role="dialog" aria-hidden="true">
														<div class="modal-dialog modal-sm" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">Detalles del cliente</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body m-3">
																	<div class="row">
																		<div class="col-md-12">
																		<div class="row">
																			<div class="col-12">
																				<h5>Nombre:</h5>
																				<p class="mb-3"><?php echo $row['CLI_nombres'] ?> <?php echo $row['CLI_apellidos'] ?></p>
																			</div>
																			<div class="col-6">
																				<h5>DNI:</h5>
																				<p class="mb-3"><?php echo $row['CLI_dni'] ?></p>
																			</div>
																			<div class="col-6">
																				<h5>Género:</h5>
																				<p class="mb-3"><?php echo $row['CLI_genero'] ?></p>
																			</div>
																		</div>
																			<div class="row">
																				<div class="col-6">
																					<h5>Móvil:</h5>
																					<p class="mb-3"><?php echo $row['CLI_movil'] ?></p>
																				</div>
																				<div class="col-6">
																					<h5>Correo:</h5>
																					<p class="mb-3"><?php echo $row['CLI_correo'] ?></p>
																				</div>
																				<div class="col-6">
																					<h5>Dirección:</h5>
																					<p class="mb-3"><?php echo $row['CLI_direccion'] ?></p>
																				</div>
																				<div class="col-6">
																					<h5>Estado:</h5>
																					<p class="mb-3"><?php
																						$estado = $row['CLI_estado'];
																						switch ($estado) {
																							case '1':
																								echo "Nuevo";
																								break;
																							case '2':
																								echo "Frecuente";
																								break;
																							case '3':
																								echo "Mayorista";
																								break;
																							default:
																								echo "No definido";
																								break;
																						}
																					?></p>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-6">
																					<h5>Tipo de usuario:</h5>
																					<p class="mb-3"><?php 
																						
																						if ($row['USU_tipo'==2]) {
																							echo "Cliente";
																						} else {
																							echo "Administrador";
																						}

																					?></p>
																				</div>
																				<div class="col-6">
																					<h5>Fecha de registro:</h5>
																					<p class="mb-0"><?php echo $row['CLI_fechaCreacion'] ?></p>
																				</div>
																				<div class="col-12">
																					<h5>Observación:</h5>
																					<p class="mb-3"><?php echo $row['CLI_observacion'] ?></p>
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
													<a class="link-eye" href="#" data-toggle="modal" data-target="#view-client"><i class="align-middle mr-1" data-feather="eye"></i></a>
													<a class="link-edit" href="edit-client.php?id=<?php echo $row['CLI_id'] ?>"><i class="align-middle mr-1" data-feather="edit-2"></i></a>
													<a class="link-delete" id="delete-client" href="#" data-id="<?php echo $row['CLI_id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
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
							<div class="mt-3" id="success-delete-client"></div>
						</div>
            </div>
        </div>
	</main>
<?php require_once("inc/footer.php"); ?>