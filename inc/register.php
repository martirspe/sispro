<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Recepcionando datos del fomulario.
$nombres = $_POST['nombres'];
$usuario = $_POST['usuario'];
$t_usuario = $_POST['t_usuario'];
$correo = $_POST['correo'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);
$estado = 1;

// Imagen asignada a los usuarios por defecto.
$img_user = 'img/default/user.png';

// Verificando que el usuario ingresado en el formulario no este registrado.
$query = "SELECT USU_usuario FROM usuarios WHERE USU_usuario = '$usuario'";
$results = mysqli_query($open_connection, $query);

if (mysqli_num_rows($results) > 0) {
    echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> El usuario ya está registrado.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
} else {
    // Registrando usuario.
    if ($password == $password2) {
        $query = "INSERT INTO usuarios (USU_imagen, USU_nombres, USU_usuario, USU_correo, USU_contraseña, USU_tipo, USU_estado, USU_fechaCreacion)
        VALUES ('$img_user','$nombres','$usuario','$correo','$password','$t_usuario','$estado',NOW())";
        $results = mysqli_query($open_connection, $query);
        
        if ($results == false) {
            echo '
                <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Error al registrar usuario.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
        } else {
            echo '1';
            /* echo '
                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Usuario registrado correctamente.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            '; */
        }
    } else {
        echo '
                <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Alerta!</strong> Las contraseñas ingresadas no coinciden.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
    }
}

include "close-connection.php"; ?>