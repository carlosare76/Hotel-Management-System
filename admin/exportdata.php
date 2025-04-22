<?php

include '../config.php';

$sqlq = "SELECT * FROM roombook";
$result = mysqli_query($conn, $sqlq);
$roombook_record = [];

while ($rows = mysqli_fetch_assoc($result)) {
    $roombook_record[] = $rows;
}

if (isset($_POST["exportexcel"])) {
    // Nombre de archivo en español para Hostal Carolinas
    $filename = "hostalcarolinas_reservas_" . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $show_column = false;
    if (!empty($roombook_record)) {
        // Encabezados en español
        $headers = [
            'ID',
            'Nombre',
            'Correo Electrónico',
            'País',
            'Teléfono',
            'Tipo Habitación',
            'Cama',
            'Comida',
            'No. Habitaciones',
            'Entrada',
            'Salida',
            'Días',
            'Estado'
        ];

        foreach ($roombook_record as $record) {
            if (!$show_column) {
                // Imprime la fila de encabezados
                echo implode("\t", $headers) . "\n";
                $show_column = true;
            }
            // Imprime los valores en el mismo orden
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}

?>
