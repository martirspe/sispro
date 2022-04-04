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
$nombre = $_POST['nombre'];
$modelo = $_POST['modelo'];
$material = $_POST['material'];
$suela = $_POST['suela'];
$color = $_POST['color'];
$marca = $_POST['marca'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$estado = 1;
$categoria = $_POST['categoria'];

// Si no existe imagen en el formulario, se le asigna uno por defecto.
if (empty($imagen)) {
    $route_xampp = 'img/default/product.png';
}
// Insertando datos en la tabla "Productos".
$query = "INSERT INTO productos (PRO_nombre, PRO_modelo, PRO_material, PRO_suela, PRO_color, PRO_marca, PRO_imagen, PRO_descripcion, PRO_precio, PRO_estado, CAT_id) VALUES ('$nombre','$modelo','$material','$suela','$color','$marca','$route_xampp','$descripcion','$precio','$estado','$categoria')";
$results = mysqli_query($open_connection, $query);

if ($results == false) {
    echo '
        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
	        <div class="alert-icon">
				<i class="far fa-fw fa-bell"></i>
			</div>
			<div class="alert-message">
				<strong>Alerta!</strong> Error al guardar producto.
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
				<strong>Alerta!</strong> Producto guardado correctamente.
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
    ';
    // Mueve la imagen del formulario al directorio correcto.
    move_uploaded_file($imagen,$route);
}

include "close-connection.php"; ?>