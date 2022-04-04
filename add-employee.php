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
	<title>Añadir Empleado - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Añadir Empleado</h1>

					<div class="row">
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Nuevo Empleado</h5>
									<h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a continuación.</h6>
								</div>
								<div class="card-body">
									<form id="add-employee" action="inc/add-employee.php" method="POST" enctype="multipart/form-data">
										<div class="form-row">
										<div class="form-group col-md-2">
											<label class="form-label">DNI</label>
											<input type="text" name="dni" maxlength="8" class="form-control" placeholder="76520901" required>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Nombres</label>
											<input type="text" name="nombres" class="form-control" placeholder="Santiago" required>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Apellidos</label>
											<input type="text" name="apellidos" class="form-control" placeholder="Díaz Saavedra" required>
										</div>
										<div class="form-group col-md-2">
											<label class="form-label">Género</label>
											<select name="genero" class="form-control first-item" required>
												<option value="">Elije</option>
												<option value="M">M</option>
												<option value="F">F</option>
											</select>
										</div>
                                        </div>
                                        <div class="form-row">
											<div class="form-group col-md-6">
												<label class="form-label">Móvil</label>
												<div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">+51</span>
                                                    </div>
													<input type="text" name="movil" maxlength="11" class="form-control" data-mask="000-000-000" placeholder="999-999-999" required>
                                                </div>
											</div>
											<div class="form-group col-md-6">
												<label class="form-label">Correo electrónico</label>
												<div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@</span>
                                                    </div>
													<input type="email" name="correo" class="form-control" placeholder="ejemplo@gmail.com" required>
                                                </div>
											</div>
											<div class="form-group col-md-6">
												<label class="form-label">Cargo</label>
												<select name="cargo" class="form-control" required>
													<option value="">Elije un cargo</option>
													<?php
													$query = "SELECT CAR_id, CAR_nombre FROM cargos";
													$results = mysqli_query($open_connection,$query);
													while ($row = mysqli_fetch_array($results)) { ?>
														<option value="<?php echo $row['CAR_id'] ?>"><?php echo $row['CAR_nombre'] ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group col-md-6">
                                                <label class="form-label">Fecha de ingreso</label>
                                                <input type="date" name="fechaIngreso" class="form-control" required>
											</div>
                                        </div>
										<div class="form-group">
											<label class="form-label">Información</label>
											<textarea class="form-control" name="informacion" placeholder="Detalla tu experiencia y aptitudes personales respecto a tu campo de trabajo." rows="4"></textarea>
										</div>
										<div class="form-group">
											<label class="form-label w-100">Foto de perfil</label>
											<input type="file" name="imagen">
											<small class="form-text text-muted">Elija la imagen del producto que va añadir.</small>
										</div>
										<button type="submit" class="btn btn-primary">Añadir Empleado</button>
										<button type="reset" class="btn btn-secondary">Limpiar</button>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-add-employee"></div>
						</div>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>