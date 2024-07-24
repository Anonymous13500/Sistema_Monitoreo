<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        h1 {
            color: #00983d;
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 30px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .div-secundarios,
        .input-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }


        #barraNavegacion {
            margin-left: 24%;
        }

        .div-secundarios {
            margin-right: 10%;
        }

        /* Estilo para el selector de fecha */
        #fechaSeleccionada {
            width: 120px;
            height: 23px;
            flex-shrink: 0;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
        }

        /* Estilo para el botón "Mostrar Datos" */
        .mostrarDatos button {
            background-color: #0, 0, 1;
            color: black;
            padding: 4px 20px;
            border: 1px solid #000;
            border-radius: 19px;
            cursor: pointer;
            /* Agrega el radio de borde */
            margin-left: 24%;
        }

        .descargar button {
            background-color: #0, 0, 1;
            color: black;
            padding: 4px 20px;
            border: 1px solid #000;
            border-radius: 19px;
            cursor: pointer;
        }

        .descargar button img {
            width: 12px;
            /* Ajusta el tamaño del ícono */
            height: 12px;
            /* Ajusta el tamaño del ícono */
        }

        /* Estilo para el selector de opción */
        #opcion {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            width: 124px;
            height: 26px;
        }

        #anioSeleccionado {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            width: 124px;
            height: 26px;
        }

        #rangoAnios {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            width: 124px;
            height: 26px;
        }

        #campus {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            width: 124px;
            height: 26px;
        }

        #edificio {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            width: 124px;
            height: 26px;
        }

        #inversor {
            font-size: 16px;
            border-radius: 19px;
            border: 1px solid #000;
            margin-bottom: 12px;
            s width: 124px;
            height: 26px;
        }



        /* Consulta de medios para dispositivos móviles */
        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
            }

            .div-secundarios {
                max-width: 50%;
            }
        }
    </style>
</head>

<body>

    <div class="flex-container">
        <title>Datos Inversor</title>
        <div class="div-secundarios">
            <label for="opcion">Tipo:</label>
            <select id="opcion" name="opcion">
                <option value="diaria">Diaria</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
            </select>
            <div id="barraNavegacion">
                <input type="date" id="fechaSeleccionada" name="fechaSeleccionada" value="<?php echo $fechaActual ?>" onchange="obtenerDatosDiarios()">
            </div>
            <!-- Selector de año -->
            <div id="barraNavegacionAnual" style="display: none;">
                <label for="anioSeleccionado">Año:</label>
                <select id="anioSeleccionado" name="anioSeleccionado" onchange="obtenerDatosMensuales()">
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
                    ?>
                </select>
            </div>

            <div id="barraNavegacionparaAnual" style="display: none;">
                <label for="rangoAnios">Rango:</label>
                <select id="rangoAnios" name="rangoAnios" onchange="obtenerDatosAnuales()">
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
                    ?>
                </select>
            </div>
            <div class="mostrarDatos">
                <button onclick="mostrarDatos2()" type="button">Mostrar</button>
            </div>
        </div>
        <div class="div-secundarios">
            <div class="input-container">
                <label for="campus">Campus:</label>
                <select id="campus" name="campus" onchange="filtrarEdificios()">
                    <option value="">Seleccione un campus</option>
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
                    ?>
                </select>
            </div>
            <div class="input-container">
                <label for="edificio">Edificio:</label>
                <select id="edificio" name="edificio" onchange="filtrarInversores()">
                    <option value="">Seleccione un edificio</option>
                </select>
            </div>
            <div class="input-container">
                <label for="inversor">Inversor:</label>
                <select id="inversor" name="inversor">
                    <option value="">Seleccione un inversor</option>
                </select>
            </div>
        </div>
        <div class="div-secundarios">
            <div class="descargar">
                <button type="button" onclick="mostrarPopup()">
                    CSV <img src="./img/descarga.png" alt="Icono">
                </button>
            </div>

            <div id="popupFormContainer" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); border:1px solid #000; padding:20px; background-color:#fff; z-index:1000;">
                <form id="popupForm" action="download_csv.php" method="post">
                    <label for="startDate">Fecha Inicio:</label>
                    <input type="date" id="startDate" name="startDate" required>
                    <br><br>
                    <label for="endDate">Fecha Fin:</label>
                    <input type="date" id="endDate" name="endDate" required>
                    <br><br>
                    <input type="submit" value="Descargar">
                    <button type="button" onclick="cerrarPopup()">Cerrar</button>
                </form>
            </div>
            <div id="popupForm" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); border:1px solid #000; padding:20px; background-color:#fff; z-index:1000;">
                <form action="download_csv.php" method="post">
                    <label for="startDate">Fecha Inicio:</label>
                    <input type="date" id="startDate" name="startDate" required>
                    <br><br>
                    <label for="endDate">Fecha Fin:</label>
                    <input type="date" id="endDate" name="endDate" required>
                    <br><br>
                    <input type="hidden" name="idinversor" id="idinversor" value="">
                    <input type="submit" value="Descargar">
                    <button type="button" onclick="cerrarPopup()">Cerrar</button>
                </form>
            </div>
        </div>
        <script>
            window.addEventListener('error', function(event) {
                console.error('Error capturado:', event.error);
            });

            function mostrarPopup() {
                var idInversor = document.getElementById('inversor').value;
                document.getElementById('idinversor').value = idInversor;
                document.getElementById('popupForm').style.display = 'block';
            }

            function cerrarPopup() {
                console.log('Cerrando popup');
                document.getElementById('popupForm').style.display = 'none';
            }
        </script>
    </div>
</body>

</html>