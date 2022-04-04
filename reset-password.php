<?php

include "inc/open-connection.php";
session_start();
if (!empty($_SESSION['active'])) {
    header("location: index.php");
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
	<title>Restablecer Contraseña - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<main class="main h-100 w-100">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Restablecer contraseña</h1>
							<p class="lead">
								Ingrese su correo electrónico para restablecer su contraseña.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form>
										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Introduce tu correo electrónico" />
										</div>
										<div class="text-center mt-3">
											<a href="index.php" class="btn btn-lg btn-primary">Restablecer contraseña</a>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Reset password</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
<?php include "inc/scripts.php"; ?>
</body>

</html>
<?php include "inc/close-connection.php"; ?>