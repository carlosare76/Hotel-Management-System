<?php
session_start();
include '../config.php';

// roombook
$roombooksql  = "SELECT * FROM roombook";
$roombookre   = mysqli_query($conn, $roombooksql);
$roombookrow  = mysqli_num_rows($roombookre);

// staff
$staffsql = "SELECT * FROM staff";
$staffre  = mysqli_query($conn, $staffsql);
$staffrow = mysqli_num_rows($staffre);

// room
$roomsql = "SELECT * FROM room";
$roomre  = mysqli_query($conn, $roomsql);
$roomrow = mysqli_num_rows($roomre);

// Conteo por tipo para gráfico de pastel
$tipos      = ['Superior Room','Deluxe Room','Guest House','Single Room'];
$conteos    = [];
foreach ($tipos as $tipo) {
    $q    = "SELECT COUNT(*) FROM roombook WHERE RoomType='$tipo'";
    $res  = mysqli_query($conn, $q);
    $conteos[] = mysqli_fetch_row($res)[0];
}

// Cálculo de ganancias (10% del total)
$query      = "SELECT cout, finaltotal FROM payment";
$result     = mysqli_query($conn, $query);
$chart_data = [];
$tot        = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $fecha  = $row['cout'];
    $profit = $row['finaltotal'] * 0.10;
    $chart_data[] = "{ date:'$fecha', profit:$profit }";
    $tot   += $profit;
}
$chart_data = implode(", ", $chart_data);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Morris.js -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <title>Hostal Carolinas - Administrador</title>
</head>
<body>
    <div class="databox">
        <div class="box roombookbox">
            <h2>Total de Habitaciones Reservadas</h2>
            <h1><?= $roombookrow ?> / <?= $roomrow ?></h1>
        </div>
        <div class="box guestbox">
            <h2>Total de Personal</h2>
            <h1><?= $staffrow ?></h1>
        </div>
        <div class="box profitbox">
            <h2>Ganancias</h2>
            <h1><?= number_format($tot, 2) ?> <span>$</span></h1>
        </div>
    </div>

    <div class="chartbox">
        <div class="bookroomchart">
            <canvas id="bookroomchart"></canvas>
            <h3 style="text-align:center; margin:10px 0;">Habitaciones Reservadas</h3>
        </div>
        <div class="profitchart">
            <div id="profitchart"></div>
            <h3 style="text-align:center; margin:10px 0;">Ganancias</h3>
        </div>
    </div>

    <script>
        // Gráfico de pastel (Chart.js)
        const pieLabels = [
            'Habitación Superior',
            'Habitación de Lujo',
            'Casa de Huéspedes',
            'Habitación Individual'
        ];
        const pieData = {
            labels: pieLabels,
            datasets: [{
                label: 'Reservas',
                data: [<?= implode(",", $conteos) ?>],
                backgroundColor: [
                    '#E06020',
                    '#E0C040',
                    '#A0A0A0',
                    '#000000'
                ],
                borderColor: '#FFFFFF'
            }]
        };
        new Chart(
            document.getElementById('bookroomchart'),
            { type: 'doughnut', data: pieData, options: {} }
        );
    </script>

    <script>
        // Gráfico de barras (Morris.js)
        Morris.Bar({
            element: 'profitchart',
            data: [<?= $chart_data ?>],
            xkey: 'date',
            ykeys: ['profit'],
            labels: ['Ganancias'],
            hideHover: 'auto',
            stacked: true,
            barColors: ['#E06020']
        });
    </script>
</body>
</html>
