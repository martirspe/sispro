<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db       = "sispro";

$open_connection = new mysqli($hostname, $username, $password)
or die("No es posible conectarse a MySQL");

mysqli_select_db($open_connection, $db)
or die("Base de datos no disponible");

if (mysqli_connect_errno()) {
    echo "No es posible conectarse a MySQL";
    exit;
}

mysqli_set_charset($open_connection, "utf8");
mysqli_query($open_connection, "SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION', lc_time_names = 'es_PE'");