<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Estilos para las cartas y gráficos */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* Para mostrar tres elementos por fila */
            margin-bottom: 30px; /* Espacio entre filas */
        }

        .card-container {
            width: calc(100% / 3 - 10px); /* Ancho de las cartas */
            margin-bottom: 20px; /* Espacio entre cartas */
        }

        .card {
            display: flex;
            justify-content: space-around;
            border-radius: 20px;
            padding: 10px;
            margin-right: 20%;
            margin-left: 20%;
            margin-bottom: 15px;
        }

        .ss {
            text-align: center;
        }

        .icons1 {
            width: 40px;
            height: 40px;
            text-align: center;
        }

        h4 {
            margin: 3px;
            text-align: center;
        }

        .text {
            width: 80px;
            height: 50px;
            text-align: center;
            font-family: Times New Roman;
            font-size: 10px;
        }

        @media (min-width: 501px) and (max-width: 768px) {

            .card-container, .chart-container {
                width: 100%; /* Ancho completo para dispositivos móviles */
                
            }
            .container {
                flex-direction: column; /* Un elemento por fila en dispositivos móviles */
            }
        }

        @media (max-width: 500px) {
            /* Estilos para dispositivos móviles */
            .container {
                flex-direction: column; /* Un elemento por fila en dispositivos móviles */
            }
            .card {
                margin-right: 10%; /* Desactivar margen derecho */
                margin-left: 10%; /* Desactivar margen izquierdo */
            }

            .card-container, .chart-container {
                width: 100%; /* Ancho completo para dispositivos móviles */
            }

            .icons1 {
                width: 30px;
                height: 30px;
            }

            h4 {
                font-size: 14px;
            }

            canvas {
                margin-bottom: 20px
            }

            .text {
                width: 100%;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div id="contenedor_principal" class="container">
        <!-- Tarjeta y gráfico de Voltage -->
        <div class="card-container">
            <div class="card" style="background: rgba(75, 192, 192, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/Voltage.png" alt="Icons Voltage">
                    <h4>Voltage</h4>
                </div>
                <div class="text">
                    <p>Fuerza o presión eléctrica que impulsa la corriente eléctrica a través de un circuito</p>
                </div>
                
            </div>
            <div class="chart-container">
                <canvas id="voltageChart"></canvas>
            </div>
        </div>
        

        <!-- Tarjeta y gráfico de Current -->
        <div class="card-container">
            <div class="card" style="background: rgba(255, 99, 132, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/Current.png" alt="Icons Current">
                    <h4>Corriente</h4>
                </div>
                <div class="text">
                    <p>Flujo de cargas eléctricas a través de un conductor</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="currentChart"></canvas>
            </div>
        </div>
        

        <!-- Tarjeta y gráfico de Power -->
        <div class="card-container">
            <div class="card" style="background: rgba(54, 162, 235, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/Power.png" alt="Icons Power">
                    <h4>Energia</h4>
                </div>
                <div class="text">
                    <p>Cantidad de energía eléctrica consumida o entregada por unidad de tiempo</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="powerChart"></canvas>
            </div>
        </div>
        

        <!-- Tarjeta y gráfico de Energy -->
        <div class="card-container">
            <div class="card" style="background: rgba(255, 206, 86, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/Energy.png" alt="Icons Energy">
                    <h4>Potencia</h4>
                </div>
                <div class="text">
                    <p>Capacidad de un sistema eléctrico para realizar trabajo</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="energyChart"></canvas>
            </div>
        </div>


        <!-- Tarjeta y gráfico de Frequency -->
        <div class="card-container">
            <div class="card" style="background: rgba(153, 102, 255, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/Freuqency.png" alt="Icons Frequency">
                    <h4>Frecuencia</h4>
                </div>
                <div class="text">
                    <p>Cantidad de ciclos de una onda sinusoidal que ocurren</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="frequencyChart"></canvas>
            </div>
        </div>
        

        <!-- Tarjeta y gráfico de Power Factor -->
        <div class="card-container">
            <div class="card" style="background: rgba(255, 159, 64, 0.25);">
                <div class='ss'>
                    <img class="icons1" src="./img/PowerFactor.png" alt="Icons Power Factor">
                    <h4>Factor de Potencia</h4>
                </div>
                <div class="text">
                    <p>Eficiencia de la conversión de energía eléctrica</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="pfChart"></canvas>
            </div>
        </div>
        

    </div>
</body>
</html>
