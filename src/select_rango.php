<?php
// Realiza una consulta para obtener el rango de años disponibles en tu base de datos
$query_min_max_years = "SELECT MIN(EXTRACT(YEAR FROM timestamp)) AS min_year, MAX(EXTRACT(YEAR FROM timestamp)) AS max_year FROM sensor_parametro_electrico";
$result_min_max_years = pg_query($conexion, $query_min_max_years);
$row_min_max_years = pg_fetch_assoc($result_min_max_years);
$min_year = $row_min_max_years['min_year'];
$max_year = $row_min_max_years['max_year'];

// Calcula los rangos de años de 10 en 10
$ranges = [];
for ($i = $min_year; $i <= $max_year; $i += 10) {
    $range_start = $i;
    $range_end = $i + 9;
    if ($range_end > $max_year) {
        $range_end = $max_year;
    }
    $ranges[] = "$range_start - $range_end";
}
// Genera las opciones del selector basadas en los rangos calculados
foreach ($ranges as $range) {
    echo "<option value=\"$range\">$range</option>";
}
