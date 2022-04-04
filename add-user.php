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
	<title>Añadir Usuario - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Añadir Usuario</h1>

					<div class="row">
						<div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Nuevo Usuario</h5>
									<h6 class="card-subtitle text-muted">Ingrese datos en todos los campos a continuación.</h6>
								</div>
								<div class="card-body">
									<form id="add-user" action="inc/add-user.php" method="POST" enctype="multipart/form-data">
										<div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Nombres</label>
                                                <input type="text" name="nombres" class="form-control" placeholder="Santiago" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Apellidos</label>
                                                <input type="text" name="apellidos" class="form-control" placeholder="Díaz Saavedra" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label">Tipo de usuario</label>
                                                <select name="tipo" class="form-control first-item" required>
                                                    <option value="">Elije un tipo de usuario</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Vendedor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Usuario</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="align-middle" data-feather="user"></i></span>
                                                    </div>
                                                    <input type="text" name="usuario" class="form-control" placeholder="sdiaz" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Contraseña</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="align-middle" data-feather="lock"></i></span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" placeholder="Introduce una contraseña" required>
                                                </div>
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
                                        </div>
                                        <div class="form-group">
											<label class="form-label w-100">Foto de perfil</label>
											<input type="file" name="imagen">
											<small class="form-text text-muted">Elija la imagen del producto que va añadir.</small>
										</div>
										<button type="submit" class="btn btn-primary">Añadir Usuario</button>
										<button type="reset" class="btn btn-secondary">Limpiar</button>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-add-user"></div>
						</div>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>