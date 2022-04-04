<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Si existe imagen en el formulario le asigan la ruta y un nuevo nombre.
$imagen = $_FILES['imagen']['tmp_name'];
$nameimg = 'img-' . date('dmY-His', time()) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); 
$route = $_SERVER['DOCUMENT_ROOT'] . '/sispro/img/products/';
$route = $route.$nameimg;

// Cuando se trabaja en XAMPP.
$route_xampp = 'img/products/';
$route_xampp = $route_xampp.$nameimg;

// Recepcionando datos del fomulario.
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$material = $_POST['material'];
$suela = $_POST['suela'];
$color = $_POST['color'];
$marca = $_POST['marca'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$estado = 1;

// Si no existe imagen en el formulario, se le asigna el mismo de la base de datos.
if (empty($imagen)) {
    $query = "SELECT PRO_imagen FROM productos WHERE PRO_id = '$id'";
    $results = mysqli_query($open_connection, $query);
    while ($row = mysqli_fetch_array($results)) {
        $route_xampp = $row['PRO_imagen'];
    }
    $query = "UPDATE productos SET PRO_imagen='$route_xampp' WHERE PRO_id='$id'";
}

// Actualizando datos del producto.
    $query = "UPDATE productos SET PRO_imagen='$route_xampp', PRO_nombre='$nombre', PRO_marca='$marca', PRO_modelo='$modelo', PRO_material='$material', PRO_suela='$suela', PRO_color='$color', PRO_precio='$precio', PRO_descripcion='$descripcion', CAT_id='$categoria' WHERE PRO_id='$id'";
    $results = mysqli_query($open_connection, $query);

    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    <strong>Alerta!</strong> Error al actualizar producto.
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
                        <strong>Alerta!</strong> No has hecho cambios para este producto.
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
                        <strong>Alerta!</strong> Producto actualizado correctamente.
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
            // Mueve la imagen del formulario al directorio correcto.
            move_uploaded_file($imagen,$route);
        }
    }

include "close-connection.php"; ?>