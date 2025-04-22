<?php

include '../config.php';
session_start();

// redirección de página
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail) {
    // usuario autenticado
} else {
    header("Location: http://localhost/hotelmanage_system/index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <!-- barra de carga -->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="../css/flash.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Hostal Carolinas - Administrador</title>
</head>

<body>
    <!-- vista móvil -->
    <div id="mobileview">
        <h5>El panel de administrador no se muestra en móvil</h5>
    </div>
  
    <!-- barra superior -->
    <nav class="uppernav">
        <div class="logo">
            <img class="bluebirdlogo" src="../image/logo.png" alt="Logotipo Hostal Carolinas">
            <p>Hostal Carolinas</p>
        </div>
        <div class="logout">
            <a href="../logout.php">
                <button class="btn btn-primary">Cerrar Sesión</button>
            </a>
        </div>
    </nav>
    <!-- menú lateral -->
    <nav class="sidenav">
        <ul>
            <li class="pagebtn active">
                <img src="../image/icon/dashboard.png" alt="Icono Panel">   Panel Principal
            </li>
            <li class="pagebtn">
                <img src="../image/icon/bed.png" alt="Icono Reserva">   Reservar Habitación
            </li>
            <li class="pagebtn">
                <img src="../image/icon/wallet.png" alt="Icono Pago">   Pagos
            </li>            
            <li class="pagebtn">
                <img src="../image/icon/bedroom.png" alt="Icono Habitaciones">   Habitaciones
            </li>
            <li class="pagebtn">
                <img src="../image/icon/staff.png" alt="Icono Personal">   Personal
            </li>
        </ul>
    </nav>

    <!-- sección principal -->
    <div class="mainscreen">
        <iframe class="frames frame1 active" src="./dashboard.php" frameborder="0"></iframe>
        <iframe class="frames frame2"       src="./roombook.php"  frameborder="0"></iframe>
        <iframe class="frames frame3"       src="./payment.php"   frameborder="0"></iframe>
        <iframe class="frames frame4"       src="./room.php"      frameborder="0"></iframe>
        <iframe class="frames frame5"       src="./staff.php"     frameborder="0"></iframe>
    </div>

    <script src="./javascript/script.js"></script>
</body>
</html>
