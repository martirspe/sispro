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
	<title>Actualizar Usuario - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
	<div class="wrapper">
		<?php require_once("inc/sidebar.php"); ?>

		<div class="main">
			<?php require_once("inc/navbar.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3 text-center">Editar Usuario</h1>

					<div class="row">
                        <?php
                        $query = "SELECT USU_id, USU_imagen, USU_nombres, USU_apellidos, USU_movil, USU_correo, USU_usuario, USU_tipo, USU_estado FROM usuarios WHERE USU_id = '$id'";
                        $results = mysqli_query($open_connection, $query);
						while ($row = mysqli_fetch_array($results)) { ?>
                        <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Actualizar Usuario</h5>
									<h6 class="card-subtitle text-muted">Edite los campos necesarios, no deje campos vacíos.</h6>
								</div>
								<div class="card-body">
									<form id="update-user" action="inc/update-user.php" method="POST" enctype="multipart/form-data">
										<div class="form-row">
                                            <div class="form-group col-md-6" hidden>
                                                <label class="form-label">ID</label>
                                                <input type="text" name="id" class="form-control" placeholder="0001" value="<?php echo $row['USU_id'] ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Nombres</label>
                                                <input type="text" name="nombres" class="form-control" placeholder="Santiago" value="<?php echo $row['USU_nombres'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Apellidos</label>
                                                <input type="text" name="apellidos" class="form-control" placeholder="Díaz Saavedra" value="<?php echo $row['USU_apellidos'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="form-label">Tipo de usuario</label>
                                                <select name="tipo" class="form-control first-item" required>
                                                    <?php
                                                        if ($row['USU_tipo'] == 1) {
                                                            echo '<option value="1">Administrador</option>';
                                                        } else {
                                                            echo '<option value="2">Vendedor</option>';
                                                        }
                                                    ?>
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
                                                    <input type="text" name="usuario" class="form-control" placeholder="sdiaz" value="<?php echo $row['USU_usuario'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Contraseña</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="align-middle" data-feather="lock"></i></span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" placeholder="Introduce una contraseña" value="">
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
													<input type="text" name="movil" maxlength="11" class="form-control" data-mask="000-000-000" placeholder="999-999-999" value="<?php echo $row['USU_movil'] ?>" required>
                                                </div>
											</div>
											<div class="form-group col-md-6">
											    <label class="form-label">Correo electrónico</label>
												<div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">@</span>
                                                    </div>
													<input type="email" name="correo" class="form-control" placeholder="ejemplo@gmail.com" value="<?php echo $row['USU_correo'] ?>" required>
                                                </div>
											</div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label class="form-label">Imagen</label>
                                                <p><img class="img-thumbnail rounded mr-2 mb-2" src="<?php echo $row['USU_imagen'] ?>" alt="<?php echo $row['USU_nombres'] ?>" width="100%" height="100%"></p>
                                            </div>
                                            <div class="form-group col-md-9 align-self-center">
                                                <label class="form-label w-100">Foto de perfil</label>
                                                <input type="file" name="imagen">
                                                <small class="form-text text-muted">Elija la imagen del producto que va añadir.</small>
                                            </div>
                                        </div>
										<button type="submit" class="btn btn-primary">Actualizar Usuario</button>
										<a href="/" class="btn btn-secondary">Salir</a>
									</form>
								</div>
							</div>
							<div class="mt-3" id="success-update-user"></div>
						</div>
                        <?php } ?>
					</div>
				</div>
			</main>
<?php require_once("inc/footer.php"); ?>