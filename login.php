<?php

include "inc/open-connection.php";

$alert = "";

session_start();
if (!empty($_SESSION['active'])) {
    header("location: index.php");
} else {
    if (!empty($_POST)) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $alert = '
                    <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Alerta!</strong> Ingrese su correo y contraseña.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                ';
        } else {
            // Recepcionando datos del fomulario.
            $email = mysqli_real_escape_string($open_connection, $_POST['email']);
            $password = md5(mysqli_real_escape_string($open_connection, $_POST['password']));

            // Buscando el correo y contraseña ingresados en login.
            $query = "SELECT * FROM usuarios WHERE USU_correo = '$email' AND USU_contraseña = '$password'";
            $results = mysqli_query($open_connection, $query);
            if (mysqli_num_rows($results) > 0) {
                $data = mysqli_fetch_array($results);
                $_SESSION['active'] = true;
                $_SESSION['USU_id'] = $data['USU_id'];
                $_SESSION['USU_imagen'] = $data['USU_imagen'];
                $_SESSION['USU_nombres'] = $data['USU_nombres'];
                $_SESSION['USU_apellidos'] = $data['USU_apellidos'];
                $_SESSION['USU_usuario'] = $data['USU_usuario'];
                $_SESSION['USU_tipo'] = $data['USU_tipo'];
                header("location: index.php");
            } else {
                $alert = '
                    <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Alerta!</strong> El usuario o contraseña son incorrectos.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                ';
                session_destroy();
            }
        }

    }
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
	<title>Iniciar Sesión - SISPRO</title>

	<?php include "inc/stylesheets.php"; ?>
	
</head>

<body>
    <main class="main h-100 w-100">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Bienvenido</h1>
                            <p class="lead">
                                Inicia sesión con tu cuenta para continuar.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="img/default/user.png" alt="" class="img-fluid rounded-circle"
                                            width="132" height="132" />
                                    </div>
                                    <form id="login" action="" method="POST">
                                        <div class="form-group">
                                            <label>Correo electrónico</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Ingresa tu correo electrónico" />
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Ingresa tu contraseña" />
                                            <small>
                                                <a href="reset-password.php">Olvidé mi contraseña</a>
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember-me" class="custom-control-input">
                                                <span class="custom-control-label">Recuérdame</span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Iniciar Sesión</button>
                                        </div>
                                        <p class="mt-4">
                                            ¿No estas registrado? <a href="register.php">Crea una cuenta</a>
                                        </p>
                                    </form>
                                    <div class="mt-3"><?php echo isset($alert) ? $alert : ""; ?></div>
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