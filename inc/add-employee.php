<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Si existe imagen en el formulario le asigan la ruta y un nuevo nombre.
$imagen = $_FILES['imagen']['tmp_name'];
$nameimg = 'img-' . date('dmY-His', time()) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); 
$route = $_SERVER['DOCUMENT_ROOT'] . '/sispro/img/employee/';
$route = $route.$nameimg;

// Cuando se trabaja en XAMPP.
$route_xampp = 'img/employee/';
$route_xampp = $route_xampp.$nameimg;

// Recepcionando datos del fomulario.
$dni = $_POST['dni'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$genero = $_POST['genero'];
$informacion = $_POST['informacion'];
$cargo = $_POST['cargo'];
$fechaIngreso = $_POST['fechaIngreso'];
$estado = 1;

//Si no existe imagen en el formulario, se le asigna uno por defecto.
if (empty($imagen)) {
    $route_xampp = 'img/default/user.png';
}

// Verificando que el DNI ingresado en el formulario no este registrado.
$query = "SELECT EMP_dni FROM empleados WHERE EMP_dni = '$dni'";
$results = mysqli_query($open_connection, $query);

if (mysqli_num_rows($results)>0) {
    echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Ya existe un empleado con el mismo DNI.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
} else {
    $query = "INSERT INTO empleados (EMP_imagen, EMP_dni, EMP_nombres, EMP_apellidos, EMP_movil, EMP_correo, EMP_genero, EMP_informacion, EMP_fechaIngreso, EMP_estado, CAR_id) VALUES ('$route_xampp','$dni','$nombres','$apellidos','$movil','$correo','$genero','$informacion','$fechaIngreso','$estado','$cargo')";
    $results = mysqli_query($open_connection, $query);
    
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al guardar empleado.
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
                    <strong>Alerta!</strong> Empleado guardado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        // Mueve la imagen del formulario al directorio correcto.
        move_uploaded_file($imagen,$route);
    }
}

include "close-connection.php"; ?>