<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Si existe imagen en el formulario le asigan la ruta y un nuevo nombre.
$imagen = $_FILES['imagen']['tmp_name'];
$nameimg = 'img-' . date('dmY-His', time()) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); 
$route = $_SERVER['DOCUMENT_ROOT'] . '/sispro/img/users/';
$route = $route.$nameimg;

/* Cuando se trabaja en XAMPP */
$route_xampp = 'img/users/';
$route_xampp = $route_xampp.$nameimg;

// Recepcionando datos del fomulario.
$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = md5($_POST['password']);
$tipo = $_POST['tipo'];
$estado = 1;

// Si no existe nueva contraseña, se le asigna el mismo de la base de datos.
if (empty($password)) {
    $query = "SELECT USU_contraseña FROM usuarios WHERE USU_id = '$id'";
    $results = mysqli_query($open_connection, $query);
    while ($row = mysqli_fetch_array($results)) {
        $password = $row['USU_contraseña'];
    }
    $query = "UPDATE usuarios SET USU_contraseña='$password' WHERE USU_id = '$id'";
}

// Si no existe imagen en el formulario, se le asigna el mismo de la base de datos.
if (empty($imagen)) {
    $query = "SELECT USU_imagen FROM usuarios WHERE USU_id = '$id'";
    $results = mysqli_query($open_connection, $query);
    while ($row = mysqli_fetch_array($results)) {
        $route_xampp = $row['USU_imagen'];
    }
    $query = "UPDATE usuarios SET USU_imagen='$route_xampp' WHERE USU_id = '$id'";
}

// Actualizar datos de los usuarios.
$query = "UPDATE usuarios SET USU_imagen='$route_xampp', USU_nombres='$nombres', USU_apellidos='$apellidos', USU_movil='$movil', USU_correo='$correo', USU_usuario='$usuario', USU_contraseña='$password', USU_tipo='$tipo', USU_estado='$estado' WHERE USU_id = '$id'";
$results = mysqli_query($open_connection, $query);
    
if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> Error al actualizar usuario.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
} else {
    if (mysqli_affected_rows($open_connection) == 0) {
        echo '
            <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> No has hecho cambios para este usuario.
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
                    <strong>Alerta!</strong> Usuario actualizado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        // Mueve la imagen del formulario al directorio correcto.
        move_uploaded_file($imagen,$route);
    }
}

include "close-connection.php"; ?>