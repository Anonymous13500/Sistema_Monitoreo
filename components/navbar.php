<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    
</head>
<body>
<script>
        <?php include './public/js/main.js'; ?>
    </script>
    <div class="navbar">
        <div class="flex-container">
            <div class="div-secundarios">
                <div class="input-container">
                    <label for="campus">Campus:</label>
                    <select id="campus" name="campus" onchange="filtrarEdificios()">
                        <option value="">Seleccione un campus</option>
                        <option value=""><?php include "./src/select_campus.php" ?></option>
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
                <div class="input-container">
                    <label for="panelSeleccionado">Panel:</label>
                    <select id="panelSeleccionado" name="panelSeleccionado">
                        <option value="">Seleccione</option>
                        <option value="1">Panel 1</option>
                        <option value="2">Panel 2</option>
                    </select>
                </div>
            </div>

            <div id="tipoGrafica" class="div-secundarios">
                <label for="opcion">Tipo:</label>
                <select id="opcion" name="opcion">
                    <option value="">Seleccione</option>
                    <option value="diaria">Diaria</option>
                    <option value="mensual">Mensual</option>
                    <option value="anual">Anual</option>
                </select>

                <div id="barraNavegacion" style="display: none;">>
                    <input type="date" id="fechaSeleccionada" name="fechaSeleccionada" value="<?php echo $fechaActual ?>" onchange="obtenerDatosDiarios()">
                </div>
                <div id="barraNavegacionAnual" style="display: none;">
                    <label for="anioSeleccionado">Año:</label>
                    <select id="anioSeleccionado" name="anioSeleccionado" onchange="obtenerDatosMensuales()">
                        <!--Select años disponibles-->
                        <option value=""><?php include "./src/select_años.php" ?></option>
                    </select>
                </div>
                <div id="barraNavegacionAnual" style="display: none;">>
                    <label for="anioSeleccionado">Año:</label>
                    <select id="anioSeleccionado" name="anioSeleccionado">
                        <!--Select Rango de años-->
                        <option value=""><?php include "./src/select_rango.php" ?></option>
                    </select>
                </div>

                <div id="mostrarDatos">
                    <button onclick="mostrarDatos2()" type="button">Enviar</button>
                </div>
            </div>

            <div class="input-container" id="botonDescargar">
                <input type="submit" value="Descargar Datos">
            </div>
        </div>
    </div>
</body>
</html>