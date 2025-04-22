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
    <title>Hostal Carolinas - Administrador de Habitaciones</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/room.css">
</head>

<body>
    <div class="addroomsection">
        <form action="" method="POST">
            <label for="troom">Tipo de Habitación:</label>
            <select name="troom" id="troom" class="form-control">
                <option value="" selected>Seleccione...</option>
                <option value="Habitación Superior">Habitación Superior</option>
                <option value="Habitación de Lujo">Habitación de Lujo</option>
                <option value="Casa de Huéspedes">Casa de Huéspedes</option>
                <option value="Habitación Individual">Habitación Individual</option>
            </select>

            <label for="bed">Tipo de Cama:</label>
            <select name="bed" id="bed" class="form-control">
                <option value="" selected>Seleccione...</option>
                <option value="Individual">Individual</option>
                <option value="Doble">Doble</option>
                <option value="Triple">Triple</option>
                <option value="Cuádruple">Cuádruple</option>
                <option value="Ninguna">Ninguna</option>
            </select>

            <button type="submit" class="btn btn-success" name="addroom">Agregar Habitación</button>
        </form>

        <?php
        if (isset($_POST['addroom'])) {
            $typeofroom = $_POST['troom'];
            $typeofbed  = $_POST['bed'];

            $sql    = "INSERT INTO room (type, bedding) VALUES ('$typeofroom', '$typeofbed')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header('Location: room.php');
                exit;
            }
        }
        ?>
    </div>

    <div class="room">
        <?php
        $sql = "SELECT * FROM room";
        $re  = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($re)) {
            $type = $row['type'];
            $id   = $row['id'];
            $bedd = $row['bedding'];
            
            // Determinar clase de color según tipo
            $classBox = match ($type) {
                'Habitación Superior'   => 'roombox roomboxsuperior',
                'Habitación de Lujo'    => 'roombox roomboxdelux',
                'Casa de Huéspedes'     => 'roombox roomboguest',
                'Habitación Individual' => 'roombox roomboxsingle',
                default                  => 'roombox'
            };
            ?>
            <div class="<?= $classBox ?>">
                <div class="text-center no-border">
                    <i class="fa-solid fa-bed fa-4x mb-2"></i>
                    <h3><?= htmlspecialchars($type) ?></h3>
                    <div class="mb-1"><?= htmlspecialchars($bedd) ?></div>
                    <a href="roomdelete.php?id=<?= $id ?>">
                        <button class="btn btn-danger">Eliminar</button>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>
