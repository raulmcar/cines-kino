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

    <div class="container my-2">
        <div class="card mb-3 py-4 bg-secondary bg-gradient rounded">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 ps-3">
                    <img 
                        src="/cine/imagenes/promociones/2por1.jpg" 
                        class="img-fluid rounded" 
                        alt="Promo 1"
                        style="object-fit: cover; height: 250px; width:450px"
                    >
                </div>
                <div class="col-md-7">
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

    <div class="container my-2">
        <div class="card mb-3 py-4 bg-secondary bg-gradient rounded my-2">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 ps-3">
                    <img 
                        src="/cine/imagenes/promociones/cumplepromo.jpg" 
                        class="img-fluid rounded" 
                        alt="Promo 1"
                        style="object-fit: cover; height: 250px; width:450px"
                    >
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">¡Entrada gratis por tu cumpleaños!</h5>
                        <p class="card-text">Celebra tu día especial con nosotros y entra gratis al cine.</p>
                        <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#promo2">
                            Saber más
                        </button>
                        <div class="collapse mt-3" id="promo2">
                            <div class="card card-body">
                                Presenta tu DNI en taquilla el mismo día de tu cumpleaños y obtén una entrada estándar sin coste. Válido solo una vez al año y no acumulable con otras promociones.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="card mb-3 py-4 bg-secondary bg-gradient rounded my-2">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 ps-3">
                    <img 
                        src="/cine/imagenes/promociones/palomitasviernes.jpg" 
                        class="img-fluid rounded" 
                        alt="Promo 1"
                        style="object-fit: cover; height: 250px; width:450px"
                    >
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">¡Palomitas gratis los viernes por la noche!</h5>
                        <p class="card-text">Disfruta de unas palomitas gratis con tu entrada en sesiones a partir de las 20:00h.</p>
                        <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#promo3">
                            Saber más
                        </button>
                        <div class="collapse mt-3" id="promo3">
                            <div class="card card-body">
                                Promoción válida solo los viernes a partir de las 20:00 h. Aplica a una entrada por persona. No acumulable con otras ofertas. 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-2">
        <div class="card mb-3 py-4 bg-secondary bg-gradient rounded my-2">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 ps-3">
                    <img 
                        src="/cine/imagenes/promociones/dorada.jpg" 
                        class="img-fluid rounded" 
                        alt="Promo 1"
                        style="object-fit: cover; height: 250px; width:450px"
                    >
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title">Asiento Dorado: Tu Entrada Vale Más</h5>
                        <p class="card-text">¡Si te toca, te devolvemos el dinero de la entrada y te regalamos 2 entradas!</p>
                        <button class="btn btn-warning" data-bs-toggle="collapse" data-bs-target="#promo4">
                            Saber más
                        </button>
                        <div class="collapse mt-3" id="promo4">
                            <div class="card card-body">
                                El Asiento Dorado se selecciona aleatoriamente antes de cada sesión y se anuncia en pantalla antes del inicio de la película. 
                                Válido solo para entradas compradas en nuestra web o taquilla. Las entradas de regalo son válidas durante 30 días.
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