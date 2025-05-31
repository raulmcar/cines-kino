<?php
    session_start();
    require_once('../modelo/reserva.php');
    require_once ('../modelo/sesion.php');
    require_once ('../modelo/pelicula.php');

    if (!isset($_SESSION['user'])){
        $_SESSION['msg'] = "Necesitas iniciar sesión para entrar aquí.";
        header('Location: ../index.php');
        exit();
    }

    $reservas = Reserva::getReservasByIdUser($_SESSION['user']['id_usuario']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../include/navbar.php'; ?>

    <?php echo "<h2 class='text-warning text-center mt-3'>Bienvenido a tu zona personal " . $_SESSION['user']['email'] . "</h2>"; ?>

    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded">
            <div class="row g-0">
                <div class="col-md-4 bg-dark d-flex justify-content-center align-items-center p-4 rounded">
                    <img src="https://github.com/raulmcar.png" class="img-fluid rounded-circle border border-dark" alt="Foto de perfil" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            <div class="col-md-8">
                <div class="card-body">
                <h3 class="card-title text-dark"><?php echo $_SESSION['user']['nombre'] . " " . $_SESSION['user']['apellidos'] ?></h3>
                <p class="card-text text-secondary">Correo: <?php echo $_SESSION['user']['email'] ?></p>
                <p class="card-text text-secondary">Teléfono: <?php echo $_SESSION['user']['telefono'] ?></p>
                <p class="card-text text-secondary">DNI: <?php echo $_SESSION['user']['dni'] ?></p>
                <p class="card-text text-secondary">Fecha de nacimiento: <?php echo $_SESSION['user']['fecha_nacimiento'] ?></p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h3 class="text-warning text-center mb-4">Tus reservas</h3>

        <?php
            if (empty($reservas)) {
                echo "<p class='text-center text-secondary'>No tienes reservas realizadas.</p>";
            } else {
                echo "<div class='row row-cols-1 row-cols-md-2 g-4'>";
                foreach ($reservas as $reserva) {
                    $sesion = Sesion::getDatosSesion($reserva['id_sesion']);
                    $pelicula = Pelicula::getPeliculaById($sesion['id_pelicula']);

                    echo "<div class='col'>";
                    echo "<div class='card border-warning shadow-sm'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title text-primary fw-bold'>{$pelicula['titulo']}</h5>";
                    echo "<p class='card-text text-secondary'>Sala: {$sesion['id_sala']}</p>";
                    echo "<p class='card-text text-secondary'>Fecha y hora: {$sesion['fecha_hora']}</p>";
                    echo "<p class='card-text text-muted'>Precio total: {$reserva['precio']} <i class='bi bi-currency-euro'></i></p>";
                    echo "<a href='/cine/controlador/generarPdfUser.php?id_reserva={$reserva['id_reserva']}' class='btn btn-outline-warning btn-sm mt-2 ms-2'>Descargar PDF</a>";
                    echo "</div></div></div>";
                }
                echo "</div>";
            }
        ?>
    </div>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>