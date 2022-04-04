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
$id = $_POST['id'];
$dni = $_POST['dni'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$genero = $_POST['genero'];
$informacion = $_POST['informacion'];
$cargo = $_POST['cargo'];
$estado = 1;

// Si no existe imagen en el formulario, se le asigna el mismo de la base de datos.
if (empty($imagen)) {
    $query = "SELECT EMP_imagen FROM empleados WHERE EMP_id = '$id'";
    $results = mysqli_query($open_connection, $query);
    while ($row = mysqli_fetch_array($results)) {
        $route_xampp = $row['EMP_imagen'];
    }
    $query = "UPDATE empleados SET EMP_imagen = '$route_xampp' WHERE EMP_id = '$id'";
}

// Actualizar datos del empleado.
$query = "UPDATE empleados SET EMP_imagen = '$route_xampp', EMP_dni = '$dni', EMP_nombres = '$nombres', EMP_apellidos = '$apellidos', EMP_movil = '$movil', EMP_correo = '$correo', EMP_genero = '$genero', EMP_informacion = '$informacion', EMP_estado = '$estado', CAR_id = '$cargo' WHERE EMP_id = '$id'";
$results = mysqli_query($open_connection, $query);
        
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al actualizar empleado.
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
                        <strong>Alerta!</strong> No has hecho cambios para este empleado.
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
                            <strong>Alerta!</strong> No has hecho cambios para este empleado.
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
                            <strong>Alerta!</strong> Empleado actualizado correctamente.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                ';
                // Mueve la imagen del formulario al directorio correcto.
                move_uploaded_file($imagen,$route);
            }
        }
    }

include "close-connection.php"; ?>