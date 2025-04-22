<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostal Carolinas - Administrador</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/roombook.css">
</head>
<body>
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="Buscar..." onkeyup="searchFun()">
    </div>

    <div class="roombooktable table-responsive-xl">
        <?php
            $paymenttablesql = "SELECT * FROM payment";
            $paymentresult   = mysqli_query($conn, $paymenttablesql);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo Habitación</th>
                    <th scope="col">Tipo Cama</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Salida</th>
                    <th scope="col">No. Días</th>
                    <th scope="col">No. Habitaciones</th>
                    <th scope="col">Tipo de Comida</th>
                    <th scope="col">Tarifa Habitación</th>
                    <th scope="col">Tarifa Cama</th>
                    <th scope="col">Comidas</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($res = mysqli_fetch_assoc($paymentresult)) {
            ?>
                <tr>
                    <td><?= $res['id'] ?></td>
                    <td><?= htmlspecialchars($res['Name']) ?></td>
                    <td><?= htmlspecialchars($res['RoomType']) ?></td>
                    <td><?= htmlspecialchars($res['Bed']) ?></td>
                    <td><?= $res['cin'] ?></td>
                    <td><?= $res['cout'] ?></td>
                    <td><?= $res['noofdays'] ?></td>
                    <td><?= $res['NoofRoom'] ?></td>
                    <td><?= htmlspecialchars($res['meal']) ?></td>
                    <td><?= number_format($res['roomtotal'], 2) ?></td>
                    <td><?= number_format($res['bedtotal'], 2) ?></td>
                    <td><?= number_format($res['mealtotal'], 2) ?></td>
                    <td><?= number_format($res['finaltotal'], 2) ?></td>
                    <td class="action">
                        <a href="invoiceprint.php?id=<?= $res['id'] ?>">
                            <button class="btn btn-primary"><i class="fa-solid fa-print"></i> Imprimir</button>
                        </a>
                        <a href="paymentdelete.php?id=<?= $res['id'] ?>">
                            <button class="btn btn-danger">Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <script>
    // Lógica de búsqueda
    function searchFun() {
        let filter = document.getElementById('search_bar').value.toUpperCase();
        let myTable = document.getElementById("table-data");
        let tr = myTable.getElementsByTagName('tr');

        for (let i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[1];
            if (td) {
                let textValue = td.textContent || td.innerHTML;
                tr[i].style.display = textValue.toUpperCase().includes(filter) ? "" : "none";
            }
        }
    }
    </script>
</body>
</html>
