<?php
    include '.\config\db_connection.php'; 

$fechaSeleccionada = isset($_GET['fechaSeleccionada']) ? $_GET['fechaSeleccionada'] : date('Y-m-d');
$idInversor = isset($_GET['idinversor']) ? $_GET['idinversor'] : 1  ;
if (!$idInversor) {
    $idInversor = 1;
}
$query = "SELECT voltage, current, power, energy, frequency, pf, idinversor, timestamp FROM sensor_parametro_electrico WHERE DATE(timestamp) = '$fechaSeleccionada'";
if ($idInversor) {
    $query .= " AND idinversor = $idInversor";
}
$query .= " ORDER BY timestamp ASC";
$result = pg_query($conexion, $query);
if (!$result) {
    die("Error al consultar datos diarios: " . pg_last_error());
}
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
pg_close($conexion);