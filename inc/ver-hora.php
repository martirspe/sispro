<?php

// Inicializando Zona Horaria.
ini_set('date.timezone', 'America/Bogota');

$time_1 = date('H:i:s', time());
$time_2 = date('d/m/Y H:i:s', time());
$time_3 = date('g:i a', strtotime($time_1));

echo $time_1;
echo "<br>";
echo $time_2;
echo "<br>";
echo $time_3;
