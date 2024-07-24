<?php
// Consulta para obtener la lista de campus con inversores
$query_campus = "SELECT sac.idambiente_campus, sac.nombre
                     FROM sensor_ambiente_campus sac
                     LEFT JOIN sensor_ambiente_edificio sae ON sac.idambiente_campus = sae.idambiente_campus
                     LEFT JOIN sensor_inversor si ON sae.idedificio = si.idedificio
                     WHERE sae.fre = true
                     GROUP BY sac.idambiente_campus, sac.nombre";
$result_campus = pg_query($conexion, $query_campus);
if ($result_campus) {
    while ($row_campus = pg_fetch_assoc($result_campus)) {
        $id_campus = $row_campus['idambiente_campus'];
        $nombre_campus = $row_campus['nombre'];
        echo "<option value=\"$id_campus\">$nombre_campus</option>";
    }
} else {
    echo "Error al obtener los campus disponibles.";
}
