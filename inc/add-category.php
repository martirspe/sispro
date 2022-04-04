<?php

include "open-connection.php";

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

// Si existe imagen en el formulario le asigan la ruta y un nuevo nombre.
$imagen = $_FILES['imagen']['tmp_name'];
$nameimg = 'img-' . date('dmY-His', time()) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
$route = $_SERVER['DOCUMENT_ROOT'] . '/sispro/img/products/category/';
$route = $route.$nameimg;

// Cuando se trabaja en XAMPP.
$route_xampp = 'img/products/category/';
$route_xampp = $route_xampp.$nameimg;

// Recepcionando datos del fomulario.
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$estado = 1;

//Si no existe imagen en el formulario, se le asigna uno por defecto.
if (empty($imagen)) {
    $route_xampp = 'img/default/category.png';
}

// Verificando que la categoría ingresada en el formulario no este registrado.
$query = "SELECT CAT_nombre FROM categorias WHERE CAT_nombre = '$nombre'";
$results = mysqli_query($open_connection, $query);

if (mysqli_num_rows($results)>0) {
    echo '
        <div class="alert alert-warning alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Ya existe una categoría con el mismo nombre.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
} else {
    $query = "INSERT INTO categorias (CAT_imagen, CAT_nombre, CAT_descripcion, CAT_estado) VALUES ('$route_xampp','$nombre','$descripcion','$estado')";
    $results = mysqli_query($open_connection,$query);
    
    if ($results == false) {
        echo '
            <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
	            <div class="alert-icon">
				    <i class="far fa-fw fa-bell"></i>
				</div>
				<div class="alert-message">
					<strong>Alerta!</strong> Error al guardar categoría.
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
					<strong>Alerta!</strong> Categoría guardada correctamente.
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
        ';
        // Mueve la imagen del formulario al directorio correcto.
        move_uploaded_file($imagen,$route);
    }
}

include "close-connection.php"; ?>