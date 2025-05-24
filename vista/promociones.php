<?php
    session_start();
    require_once('../modelo/pelicula.php');

    unset($_SESSION['peliculaElegida']);
    unset($_SESSION['sesionElegida']);
    unset($_SESSION['asientosElegidos']);
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
<body class="d-flex flex-column min-vh-100">
    <?php include '../include/navbar.php'; ?>

    <div class="container my-4">
        <div class="card mb-3 py-5 bg-secondary bg-gradient rounded my-5">
            <div class="row g-0 align-items-center">
            <div class="col-md-4">
                <img src="img/promocion1.jpg" class="img-fluid rounded-start" alt="Promo 1">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">¡2x1 en entradas los miércoles!</h5>
                <p class="card-text">Disfruta del mejor cine a mitad de precio.</p>
                <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#promo1">
                    Saber más
                </button>
                <div class="collapse mt-3" id="promo1">
                    <div class="card card-body">
                    Aplica solo a sesiones estándar. No acumulable con otras promociones. Presenta tu código en taquilla o app.
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    <?php include '../include/footer.php'; ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>