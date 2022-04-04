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
	<title>Actualizar Cliente - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Cliente</h1>

					<div class="row">
                        <?php
						$query = "SELECT CLI_id, CLI_genero, CLI_dni, CLI_nombres, CLI_apellidos, CLI_direccion, CLI_correo, CLI_movil, CLI_observacion, CLI_tipo, CLI_estado, CLI_fechaCreacion FROM clientes WHERE CLI_id = '$id'";
						$results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
						<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Actualizar Cliente</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form id="update-client" action="inc/update-client.php" method="POST">
										<div class="form-row">
										<div class="form-group col-md-2">
											<label class="form-label">DNI</label>
											<input type="text" name="dni" maxlength="8" class="form-control" placeholder="76520901" value="<?php echo $row['CLI_dni'] ?>" required>
											<input type="number" name="id" class="form-control" value="<?php echo $row['CLI_id'] ?>" hidden>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Nombres</label>
											<input type="text" name="nombres" class="form-control" placeholder="Santiago" value="<?php echo $row['CLI_nombres'] ?>" required>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Apellidos</label>
											<input type="text" name="apellidos" class="form-control" placeholder="Díaz Saavedra" value="<?php echo $row['CLI_apellidos'] ?>" required>
										</div>
										<div class="form-group col-md-2">
											<label class="form-label">Género</label>
											<select name="genero" class="form-control first-item" required>
												<option value="<?php echo $row['CLI_genero'] ?>"><?php echo $row['CLI_genero'] ?></option>
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
													<input type="text" name="movil" maxlength="11" class="form-control" data-mask="000-000-000" placeholder="999-999-999" value="<?php echo $row['CLI_movil'] ?>" required>
                                                </div>
											</div>
											<div class="form-group col-md-6">
											<label class="form-label">Correo electrónico</label>
												<div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@</span>
                                                    </div>
													<input type="email" name="correo" class="form-control" placeholder="ejemplo@gmail.com" value="<?php echo $row['CLI_correo'] ?>">
                                                </div>
											</div>
                                        </div>
                                        <div class="form-group">
											<label class="form-label">Dirección</label>
											<input type="text" name="direccion" class="form-control" placeholder="Av. Marginal #145 - ATE, Lima." value="<?php echo $row['CLI_direccion'] ?>" required>
										</div>
										<div class="form-group">
											<label class="form-label">Observación</label>
											<textarea class="form-control" name="observacion" placeholder="Detalla las observaciones para este cliente." rows="4"><?php echo $row['CLI_observacion'] ?></textarea>
										</div>
										<button type="submit" class="btn btn-primary">Actualizar Cliente</button>
										<a href="/" class="btn btn-secondary">Salir</a>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-update-client"></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>