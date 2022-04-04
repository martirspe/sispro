<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Si existe imagen en el formulario le asigan la ruta y un nuevo nombre.
$imagen = $_FILES['imagen']['tmp_name'];
$nameimg = 'img-' . date('dmY-His', time()) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); 
$route = $_SERVER['DOCUMENT_ROOT'] . '/sispro/img/users/';
$route = $route.$nameimg;

// Cuando se trabaja en XAMPP.
$route_xampp = 'img/users/';
$route_xampp = $route_xampp.$nameimg;

// Recepcionando datos del fomulario.
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = md5($_POST['password']);
$tipo = $_POST['tipo'];
$estado = 1;

// Si no existe imagen en el formulario, se le asigna uno por defecto.
if (empty($imagen)) {
    $route_xampp = 'img/default/user.png';
}

// Verificando que el usuario ingresado en el formulario no este registrado.
$query = "SELECT USU_usuario FROM usuarios WHERE USU_usuario = '$usuario'";
$results = mysqli_query($open_connection, $query);

if (mysqli_num_rows($results)>0) {
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
    $query = "INSERT INTO usuarios (USU_imagen, USU_nombres, USU_apellidos, USU_movil, USU_correo, USU_usuario, USU_contraseña, USU_tipo, USU_estado, USU_fechaCreacion)
    VALUES ('$route_xampp','$nombres','$apellidos','$movil','$correo','$usuario','$password','$tipo','$estado',NOW())";
    $results = mysqli_query($open_connection, $query);
    
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
	            <div class="alert-icon">
				    <i class="far fa-fw fa-bell"></i>
				</div>
				<div class="alert-message">
					<strong>Alerta!</strong> Error al guardar usuario.
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
        ';
    } else {
        echo '
            <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Usuario guardado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        // Mueve la imagen del formulario al directorio correcto.
        move_uploaded_file($imagen,$route);
    }
}

include "close-connection.php"; ?>