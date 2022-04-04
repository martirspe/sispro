<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Recepcionando datos del fomulario.
$genero = $_POST['genero'];
$dni = $_POST['dni'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$movil = $_POST['movil'];
$correo = $_POST['correo'];
$observacion = $_POST['observacion'];
$estado = 1;
$tipo = 1;

// Verificando que el DNI ingresado en el formulario no este registrado.
$query = "SELECT CLI_dni FROM clientes WHERE CLI_dni = '$dni'";
$results = mysqli_query($open_connection, $query);

if (mysqli_num_rows($results)>0) {
    echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Ya existe un cliente con el mismo DNI.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
} else {
    $query = "INSERT INTO clientes (CLI_genero, CLI_dni, CLI_nombres, CLI_apellidos, CLI_direccion, CLI_movil, CLI_correo, CLI_observacion, CLI_fechaCreacion, CLI_estado, CLI_tipo)
    VALUES ('$genero','$dni','$nombres','$apellidos','$direccion','$movil','$correo','$observacion',NOW(),'$estado','$tipo')";
    $results = mysqli_query($open_connection, $query);
    
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al guardar cliente.
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
                    <strong>Alerta!</strong> Cliente guardado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    }
}

include "close-connection.php"; ?>