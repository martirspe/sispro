<?php

include "open-connection.php";

if (!empty($_POST)) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
            <div class="alert-icon">
                <i class="far fa-fw fa-bell"></i>
            </div>
            <div class="alert-message">
                <strong>Alerta!</strong> No puedes iniciar sesión con los campos vacíos.
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>';
    } else {
        // Recepcionando datos del fomulario.
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Buscando el correo y contraseña ingresados en login.
        $query = "SELECT * FROM usuarios WHERE USU_correo = '$email' AND USU_contraseña = MD5('$password')";
        $results = mysqli_query($open_connection, $query);

        if (mysqli_num_rows($results) > 0) {
            echo '1';
        } else {
            echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                <strong>Alerta!</strong> Correo o contraseña incorrectos.
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>';
        }
    }
}
include "close-connection.php"; ?>