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
	<title>Configuración de Perfil - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>
        <?php
			$query = "SELECT LPAD(USU_id, 4, '0') AS USU_id, USU_imagen, USU_usuario, USU_nombres, USU_apellidos, USU_movil, USU_correo, USU_tipo, USU_fechaCreacion FROM usuarios WHERE USU_id = '" . $_SESSION['USU_id'] . "'";
			$results = mysqli_query($open_connection, $query);
				if (mysqli_num_rows($results) > 0) {
					while ($row = mysqli_fetch_array($results)) { ?>
		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Configuración</h1>

					<div class="row">
						<div class="col-md-3 col-xl-3">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Configuración de perfil</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
          Cuenta
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
          Contraseña
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
            Privacidad y seguridad
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
            Notificaciónes de correo
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
            Notificaciones web
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          Widgets
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
            Tu información
        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
          Eliminar cuenta
        </a>
								</div>
							</div>
						</div>
                        
						<div class="col-md-9 col-xl-9">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">
											<div class="card-actions float-right">
												<div class="dropdown show">
													<a href="#" data-toggle="dropdown" data-display="static">
                  <i class="align-middle" data-feather="more-horizontal"></i>
                </a>

													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#">Action</a>
														<a class="dropdown-item" href="#">Another action</a>
														<a class="dropdown-item" href="#">Something else here</a>
													</div>
												</div>
											</div>
											<h5 class="card-title mb-0">Información pública</h5>
										</div>
										<div class="card-body">
											<form>
												<div class="row">
													<div class="col-md-8">
														<div class="form-group">
															<label for="inputUsername">Usuario</label>
															<input type="text" class="form-control" id="inputUsername" value="<?php echo $row['USU_usuario'] ?>" placeholder="Usuario">
														</div>
														<div class="form-group">
															<label for="inputUsername">Biografía</label>
															<textarea rows="2" class="form-control" id="inputBio" placeholder="Escribe algo sobre ti"></textarea>
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">
															<img alt="<?php echo $row['USU_nombres'] ?>" src="<?php echo $row['USU_imagen'] ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
															<div class="mt-2">
																<span class="btn btn-primary"><i class="fas fa-upload"></i> Subir foto</span>
															</div>
															<small>Para obtener los mejores resultados, use una imagen de al menos 128px por 128px en formato .jpg</small>
														</div>
													</div>
												</div>

												<button type="submit" class="btn btn-primary">Guardar cambios</button>
											</form>

										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<div class="card-actions float-right">
												<div class="dropdown show">
													<a href="#" data-toggle="dropdown" data-display="static">
                  <i class="align-middle" data-feather="more-horizontal"></i>
                </a>

													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#">Action</a>
														<a class="dropdown-item" href="#">Another action</a>
														<a class="dropdown-item" href="#">Something else here</a>
													</div>
												</div>
											</div>
											<h5 class="card-title mb-0">Información privada</h5>
										</div>
										<div class="card-body">
											<form>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputFirstName">Nombres</label>
														<input type="text" class="form-control" id="inputFirstName" value="<?php echo $row['USU_nombres'] ?>" placeholder="Nombres">
													</div>
													<div class="form-group col-md-6">
														<label for="inputLastName">Apellidos</label>
														<input type="text" class="form-control" id="inputLastName" value="<?php echo $row['USU_apellidos'] ?>" placeholder="Apellidos">
													</div>
												</div>
												<div class="form-group">
													<label for="inputEmail4">Correo</label>
													<input type="email" class="form-control" id="inputEmail4" value="<?php echo $row['USU_correo'] ?>" placeholder="Correo">
												</div>
												<div class="form-group">
													<label for="inputAddress">Dirección</label>
													<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
												</div>
												<div class="form-group">
													<label for="inputAddress2">Dirección 2</label>
													<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label for="inputCity">Ciudad</label>
														<input type="text" class="form-control" id="inputCity">
													</div>
													<div class="form-group col-md-4">
														<label for="inputState">Departamento</label>
														<select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
													</div>
													<div class="form-group col-md-2">
														<label for="inputZip">Código postal</label>
														<input type="text" class="form-control" id="inputZip">
													</div>
												</div>
												<button type="submit" class="btn btn-primary">Guardar cambios</button>
											</form>

										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Contraseña</h5>

											<form>
												<div class="form-group">
													<label for="inputPasswordCurrent">Contraseña actual</label>
													<input type="password" class="form-control" id="inputPasswordCurrent">
													<small><a href="#">¿Olvidaste tu contraseña?</a></small>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew">Nueva contraseña</label>
													<input type="password" class="form-control" id="inputPasswordNew">
												</div>
												<div class="form-group">
													<label for="inputPasswordNew2">Verificar contraseña</label>
													<input type="password" class="form-control" id="inputPasswordNew2">
												</div>
												<button type="submit" class="btn btn-primary">Guardar cambios</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
            </main>
                    <?php } } ?>
<?php require_once("inc/footer.php"); ?>