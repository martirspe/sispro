<?php

include "inc/open-connection.php";
session_start();
if (empty($_SESSION['active'])) {
    header("location: login.php");
}

$id = $_GET['id'];

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
	<title>Actualizar Empleado - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Empleado</h1>

					<div class="row">
                        <?php
						$query = "SELECT EMP.EMP_id, EMP.EMP_imagen, EMP.EMP_dni, EMP.EMP_nombres, EMP.EMP_apellidos, EMP.EMP_movil, EMP.EMP_correo, EMP.EMP_genero, EMP.EMP_informacion, EMP.CAR_id, CAR.CAR_nombre FROM empleados EMP INNER JOIN cargos CAR ON EMP.CAR_id = CAR.CAR_id WHERE EMP.EMP_id = '$id'";
						$results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
							<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title">Actualizar Empleado</h5>
										<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
									</div>
									<div class="card-body">
										<form id="update-employee" action="inc/update-employee.php" method="POST" enctype="multipart/form-data">
											<div class="form-row">
											<div class="form-group col-md-2">
												<label class="form-label">DNI</label>
												<input type="text" name="dni" maxlength="8" class="form-control" placeholder="76520901" value="<?php echo $row['EMP_dni'] ?>" required>
												<input type="number" name="id" class="form-control" value="<?php echo $row['EMP_id'] ?>" hidden>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Nombres</label>
												<input type="text" name="nombres" class="form-control" placeholder="Santiago" value="<?php echo $row['EMP_nombres'] ?>" required>
											</div>
											<div class="form-group col-md-4">
												<label class="form-label">Apellidos</label>
												<input type="text" name="apellidos" class="form-control" placeholder="Díaz Saavedra" value="<?php echo $row['EMP_apellidos'] ?>" required>
											</div>
											<div class="form-group col-md-2">
												<label class="form-label">Género</label>
												<select name="genero" class="form-control" required>
													<option value="<?php echo $row['EMP_genero'] ?>"><?php echo $row['EMP_genero'] ?></option>
													<?php
													if ($row['EMP_genero'] == 'M') { ?>
														<option value="F">F</option>
														<?php
													} else { ?>
														<option value="M">M</option>
													<?php } ?>
												</select>
											</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label class="form-label">Móvil</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text">+51</span>
														</div>
														<input type="text" name="movil" maxlength="11" class="form-control" data-mask="000-000-000" placeholder="999-999-999" value="<?php echo $row['EMP_movil'] ?>" required>
                                                	</div>
												</div>
												<div class="form-group col-md-4">
													<label class="form-label">Correo electrónico</label>
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text">@</span>
														</div>
														<input type="email" name="correo" class="form-control" placeholder="ejemplo@gmail.com" value="<?php echo $row['EMP_correo'] ?>" required>
                                                	</div>
												</div>
												<div class="form-group col-md-4">
													<label class="form-label">Cargo</label>
													<select name="cargo" class="form-control" required>
														<option value="<?php echo $row['CAR_id'] ?>"><?php echo $row['CAR_nombre'] ?></option>
														<?php
														$query = "SELECT CAR_id, CAR_nombre FROM cargos";
														$results = mysqli_query($open_connection,$query);
														while ($row_c = mysqli_fetch_array($results)) { ?>
															<option value="<?php echo $row_c['CAR_id'] ?>"><?php echo $row_c['CAR_nombre'] ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">Información</label>
												<textarea class="form-control" name="informacion" placeholder="Detalla tu experiencia y aptitudes personales respecto a tu campo de trabajo." rows="4"><?php echo $row['EMP_informacion'] ?></textarea>
											</div>
											<div class="form-row">
												<div class="form-group col-md-3">
													<label class="form-label">Imagen</label>
													<p><img class="img-thumbnail rounded mr-2 mb-2" src="<?php echo $row['EMP_imagen'] ?>" alt="<?php echo $row['EMP_nombres'] ?>" width="100%" height="100%"></p>
												</div>
												<div class="form-group col-md-9 align-self-center">
													<label class="form-label w-100">Cambiar Imagen</label>
													<input type="file" name="imagen">
													<small class="form-text text-muted">Elija una nueva imagen para este producto.</small>
												</div>
											</div>
											<button type="submit" class="btn btn-primary">Actualizar Empleado</button>
											<a href="/" class="btn btn-secondary">Salir</a>
										</form>
									</div>
								</div>
								<div class="mt-3" id="success-update-employee"></div>
							</div>
						<?php } ?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>