<?php
    session_start();
    require_once('../modelo/asiento.php');
    require_once('../modelo/sesion.php');
    require_once('../modelo/pelicula.php');

    if (isset($_SESSION['peliculaElegida'])){
        unset($_SESSION['peliculaElegida']);
    }

    $sesion = Sesion::getDatosSesion($_POST['id_sesion']);
    $pelicula = Pelicula::getPeliculaById($sesion['id_pelicula']);
    $asientos = Asiento::desplegarAsientos($sesion['id_sala']);
    $fechaFormateada = date('d-m-Y H:i', strtotime($sesion['fecha_hora']));
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
    <link rel="stylesheet" href="/cine/css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include '../include/navbar.php'; ?>

    <div class="row justify-content-center">
        <div class="col-md-5 m-4">
            <div class="bg-secondary bg-gradient rounded p-4 text-warning" style="--bs-bg-opacity: .7;">
                <h3 class="mb-4 border-bottom pb-2 text-center">Resumen de tu compra:</h3>

                <div class="text-center mb-4">
                    <img class="img-fluid border-radius-lg shadow rounded"
                        src="../imagenes/carteles/<?= $pelicula['titulo'] ?>.jpg"
                        alt="<?= $pelicula['titulo'] ?>"
                        style="height: 300px; width: 300px; object-fit: cover;">
                </div>

                <div class="mb-3 text-center">
                    <h4 class="fw-bold"><?= $pelicula['titulo'] ?></h4>
                    <p class="mb-1 fs-5">Sala: <?= $sesion['id_sala'] ?></p>
                    <p class="mb-1 fs-5">Fecha y hora: <?= $fechaFormateada ?></p>
                </div>

                <div>
                    <h5 class="fw-semibold mt-5">Asientos seleccionados:</h5>
                    <ul class="list-unstyled mb-0">

                <?php
                    $asientos = Asiento::getAsientosByIds($_POST['asientosReservados']);
                    foreach ($asientos as $asiento) {
                        echo "<li><i class='bi bi-ticket-perforated'></i>  Fila {$asiento['fila']} - Asiento {$asiento['numero']}</li>";
                    }
                ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <?php include '../include/footer.php'; ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>