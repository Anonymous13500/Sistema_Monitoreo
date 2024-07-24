<?php

// Realiza una consulta para obtener los años disponibles en tu base de datos
$query_years = "SELECT DISTINCT EXTRACT(YEAR FROM timestamp) AS year FROM sensor_parametro_electrico ORDER BY year ASC";
$result_years = pg_query($conexion, $query_years);

// Itera sobre los resultados de la consulta para generar las opciones del selector de años
if ($result_years) {
    while ($row_year = pg_fetch_assoc($result_years)) {
        $year = $row_year['year'];
        echo "<option value=\"$year\">$year</option>";
    }
} else {
    echo "Error al obtener los años disponibles.";
}

if (isset($_POST['fechaSeleccionada'])) {
    $fechaActual = $_POST['fechaSeleccionada'];
} else {
    $fechaActual = date('Y-m-d');
}
