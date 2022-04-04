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
	<title>Registro - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<main class="main h-100 w-100">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Registrarse</h1>
							<p class="lead">Crea tu cuenta y organízate fácilmente.</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form id="register" action="inc/register.php" method="POST">
										<div class="form-group">
											<label>Nombre</label>
											<input class="form-control form-control-lg" type="text" name="nombres" placeholder="Juan Díaz Canseco" required>
										</div>
										<div class="form-group">
											<label>Usuario</label>
											<input class="form-control form-control-lg" type="text" name="usuario" placeholder="jcanseco" required>
										</div>
										<div class="form-group">
											<label class="form-label">Tipo de usuario</label>
                                            <select name="t_usuario" class="form-control first-item" required>
                                                <option value="">Elije</option>
                                                <option value="2">Vendedor</option>
                                            </select>
										</div>
										<div class="form-group">
											<label>Email</label>
											<input class="form-control form-control-lg" type="email" name="correo" placeholder="ejemplo@gmail.com" required>
										</div>
										<div class="form-group">
											<label>Contraseña</label>
											<input class="form-control form-control-lg" type="password" name="password" minlength="8" placeholder="Crea tu contraseña" required>
                                        </div>
                                        <div class="form-group">
											<label>Confirmar contraseña</label>
											<input class="form-control form-control-lg" type="password" name="password2" placeholder="Repite tu contraseña" required/>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Registrarme</button>
										</div>
									</form>
                                </div>
                                <div class="mt-3" id="success-register"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    </main>
	</div>
</div>
<?php include "inc/scripts.php"; ?>
</body>

</html>
<?php include "inc/close-connection.php"; ?>