<?php
$dbHost = 'localhost';
$dbName = 'sensor_data';
$dbUser = 'postgres';
$dbPassword = 'root';
$conexion = pg_connect("host=$dbHost dbname=$dbName user=$dbUser password=$dbPassword");
if (!$conexion) {
    die("Error de conexión: " . pg_last_error());
}
date_default_timezone_set('America/Guayaquil');
?>