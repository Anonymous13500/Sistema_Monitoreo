<?php
include 'db_connection.php';
$edificioSeleccionado = isset($_GET['edificio']) ? $_GET['edificio'] : null;
if ($edificioSeleccionado) {
    $query = "SELECT idinversor, detalle FROM sensor_inversor WHERE idedificio = $edificioSeleccionado";
    $result = pg_query($conexion, $query);
    if (!$result) {
        die("Error al obtener los inversores: " . pg_last_error());
    }
    $inversores = array();
    while ($row = pg_fetch_assoc($result)) {
        $inversores[] = $row;
    }
    echo json_encode($inversores);
} else {
    echo "Error: Edificio no especificado.";
}
pg_close($conexion);
?>