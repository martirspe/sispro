<?php

include "open-connection.php";

// Recepcionando datos del fomulario.
$id = $_POST['id'];
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

// Insertando datos a la tabla "Clientes".
$query = "UPDATE clientes SET CLI_genero='$genero', CLI_dni='$dni', CLI_nombres='$nombres',CLI_apellidos='$apellidos',CLI_direccion='$direccion',CLI_correo='$correo',CLI_movil='$movil',CLI_observacion='$observacion',CLI_tipo='$tipo',CLI_estado='$estado' WHERE CLI_id='$id'";
$results = mysqli_query($open_connection, $query);
    
if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> Error al actualizar cliente.
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
                    <strong>Alerta!</strong> No has hecho cambios para este cliente.
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
                    <strong>Alerta!</strong> Cliente actualizado correctamente.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    }
}

include "close-connection.php"; ?>