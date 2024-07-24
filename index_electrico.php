<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Sistema de Monitoreo UTM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./public/css/navbar.css">
    <link rel="stylesheet" href="./public/css/graficas.css">
    <link rel="stylesheet" href="./public/css/cards.css">
</head>

<body>
    <?php
    include './config/db_connection.php';
    $fechaActual = date('Y-m-d');
    ?>
    <div class="container">
        <form method="post">
            <?php include './components/navbar.php'; ?>
        </form>
    </div>
    <div class="container-graficas">
        <?php
        $cards = [
            [
                'title' => 'Voltage',
                'content' => 'Diferencia de potencial eléctrico entre dos puntos',
                'bgcolor' => 'rgba(75, 192, 192, 1)',
                'chartId' => 'voltageChart'
            ],
            [
                'title' => 'Corriente',
                'content' => 'Flujo de cargas eléctricas a través de un conductor',
                'bgcolor' => 'rgba(255, 99, 132, 1)',
                'chartId' => 'currentChart'
            ],
            [
                'title' => 'Energía',
                'content' => 'Cantidad de energía eléctrica consumida o entregada por unidad de tiempo',
                'bgcolor' => 'rgba(54, 162, 235, 1)',
                'chartId' => 'powerChart'
            ],
            [
                'title' => 'Potencia',
                'content' => 'Capacidad de un sistema eléctrico para realizar trabajo',
                'bgcolor' => 'rgba(255, 206, 86, 1)',
                'chartId' => 'energyChart'
            ],
            [
                'title' => 'Frecuencia',
                'content' => 'Cantidad de ciclos de una onda sinusoidal que ocurren',
                'bgcolor' => 'rgba(153, 102, 255, 1)',
                'chartId' => 'frequencyChart'
            ],
            [
                'title' => 'Factor de Potencia',
                'content' => 'Eficiencia de la conversión de energía eléctrica',
                'bgcolor' => 'rgba(255, 159, 64, 1)',
                'chartId' => 'pfChart'
            ]
        ];

        foreach ($cards as $card) {
            $title = $card['title'];
            $content = $card['content'];
            $bgcolor = $card['bgcolor'];
            $chartId = $card['chartId'];
            ?>
            <div class="card-container">
                <?php include './components/cards.php'; ?>
                <div class="chart-container">
                    <canvas id="<?php echo $chartId; ?>"></canvas>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <script>
        <?php include './public/js/main.js'; ?>
    </script>
</body>

</html>
