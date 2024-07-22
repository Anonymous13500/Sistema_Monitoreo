<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Monitoreo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card-container {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .card-container i {
            font-size: 50px;
            color: #000;
            cursor: pointer;
        }

        .card {
            display: none;
            background-color: #e0d4f7;
            border-radius: 15px;
            padding: 20px;
            width: 300px;
            text-align: center;
            position: absolute;
            top: 60px;
            left: 0;
            z-index: 10;
        }

        .card-container:hover .card {
            display: block;
        }
    </style>
</head>
<body>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php
        $cards = [
            [
                'title' => 'Frequency',
                'content' => 'Cantidad de ciclos de una onda sinusoidal que ocurren',
                'bgcolor' => '#e0d4f7'
            ],
            [
                'title' => 'Voltage',
                'content' => 'Diferencia de potencial eléctrico entre dos puntos',
                'bgcolor' => '#d4f7e0'
            ]
        ];

        foreach ($cards as $card) {
            $title = $card['title'];
            $content = $card['content'];
            $bgcolor = $card['bgcolor'];
            include './components/cards.php';
        }
        ?>
        <h1 class="jp">Jefferson</h1>
    </div>
</body>
</html>
