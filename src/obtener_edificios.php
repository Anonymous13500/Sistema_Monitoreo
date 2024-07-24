<?php
include 'db_connection.php';
$campusSeleccionado = isset($_GET['campus']) ? $_GET['campus'] : null;
if ($campusSeleccionado) {
    $query = "SELECT iditem, nombre FROM sensor_ambiente_edificio WHERE idambiente_campus = $campusSeleccionado AND fre = true";
    $result = pg_query($conexion, $query);
    if (!$result) {
        die("Error al obtener los edificios: " . pg_last_error());
    }
    $edificios = array();
    while ($row = pg_fetch_assoc($result)) {
        $edificios[] = $row;
    }
    echo json_encode($edificios);
} else {
    echo "Error: Campus no especificado.";
}
pg_close($conexion);
?>