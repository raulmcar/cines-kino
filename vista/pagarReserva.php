<?php
    session_start();
    require_once('../modelo/asiento.php');
    require_once('../modelo/sesion.php');
    require_once('../modelo/pelicula.php');

    $sesion = Sesion::getDatosSesion($_POST['id_sesion']); // No me va esto
    $fechaFormateada = date('d-m-Y H:i', strtotime($sesion['fecha_hora']));
    $asientos = Asiento::getAsientosByIds($_POST['asientosReservados']);

    $_SESSION['sesionElegida'] = $sesion;
    $_SESSION['asientosElegidos'] = $asientos;
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
                        src="../imagenes/carteles/<?= $_SESSION['peliculaElegida']['titulo'] ?>.jpg"
                        alt="<?= $_SESSION['peliculaElegida']['titulo'] ?>"
                        style="height: 300px; width: 300px; object-fit: cover;">
                </div>

                <div class="mb-3 text-center">
                    <h4 class="fw-bold"><?= $_SESSION['peliculaElegida']['titulo'] ?></h4>
                    <p class="mb-1 fs-5">Sala: <?= $_SESSION['sesionElegida']['id_sala'] ?></p>
                    <p class="mb-1 fs-5">Fecha y hora: <?= $fechaFormateada ?></p>
                </div>

                <div>
                    <h5 class="fw-semibold mt-5">Asientos seleccionados:</h5>
                    <ul class="list-unstyled mb-0">

                <?php
                    foreach ($asientos as $asiento) {
                        echo "<li><i class='bi bi-ticket-perforated'></i>  Fila {$asiento['fila']} - Asiento {$asiento['numero']}</li>";
                    }
                ?>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-5 m-4">
            <div class="bg-secondary bg-gradient rounded p-4 text-warning" style="--bs-bg-opacity: .7;">
                <h3 class="mb-4 border-bottom pb-2 text-center">Datos de usuario y pago</h3>

                <form method="POST" action="/cine/controlador/procesarReserva.php" id="formPago">
                    <?php
                        if (!isset($_SESSION['user'])) {
                            echo "<div class='mb-4'>
                                <p class='fw-semibold'>¿Quieres continuar como invitado? Enviaremos tu entradas a este correo electónico</p>
                                <input type='email' class='form-control mb-3' name='correo_invitado_reserva' placeholder='Correo electrónico'>

                                <p class='fw-semibold'>O inicia sesión:</p>
                                <input type='email' class='form-control mb-2' name='correo_reserva' placeholder='Correo electrónico'>
                                <input type='password' class='form-control mb-3' name='contrasena_reserva' placeholder='Contraseña'>
                            </div>";
                        }
                    ?>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="fw-semibold mb-0">Información de pago:</p>
                        <div>
                            <button type="button" class="btn btn-warning me-2" id="btnTarjeta">
                                <i class="bi bi-credit-card-2-front-fill"></i> Tarjeta
                            </button>
                            <button type="button" class="btn btn-primary" id="btnPaypal">
                                <i class="bi bi-paypal"></i> PayPal
                            </button>
                        </div>
                    </div>

                    <div id="formTarjeta">
                        <div class="mb-3">
                            <label for="nombre_tarjeta" class="form-label">Nombre en la tarjeta</label>
                            <input type="text" class="form-control" id="nombre_tarjeta" name="nombre_tarjeta" required>
                        </div>

                        <div class="mb-3">
                            <label for="numero_tarjeta" class="form-label">Número de tarjeta</label>
                            <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" maxlength="16" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="caducidad" class="form-label">Fecha de caducidad</label>
                                <input type="month" class="form-control" id="caducidad" name="caducidad" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" maxlength="4" required>
                            </div>
                        </div>
                    </div>

                    <div id="formPaypal" style="display: none;">
                        <div class="alert alert-info">Introduce tus datos de PayPal para completar el pago.</div>

                        <div class="mb-3">
                            <label for="paypal_email" class="form-label">Correo de PayPal</label>
                            <input type="email" class="form-control" id="paypal_email" name="paypal_email">
                        </div>

                        <div class="mb-3">
                            <label for="paypal_contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="paypal_contrasena" name="paypal_contrasena">
                        </div>
                    </div>

                    <input type="hidden" name="metodo_pago" id="metodo_pago" value="tarjeta">
                    <button type="submit" class="btn btn-warning w-100 mt-3">Pagar y confirmar</button>
                </form>
            </div>
        </div>
    </div>
    
    <?php include '../include/footer.php'; ?>

    <script>
        const btnTarjeta = document.getElementById('btnTarjeta');
        const btnPaypal = document.getElementById('btnPaypal');
        const formTarjeta = document.getElementById('formTarjeta');
        const formPaypal = document.getElementById('formPaypal');
        const metodoPago = document.getElementById('metodo_pago');

        btnTarjeta.addEventListener('click', () => {
            formTarjeta.style.display = 'block';
            formPaypal.style.display = 'none';
            metodoPago.value = 'tarjeta';

            formTarjeta.querySelectorAll('input').forEach(input => input.required = true);
            formPaypal.querySelectorAll('input').forEach(input => input.required = false);
        });

        btnPaypal.addEventListener('click', () => {
            formTarjeta.style.display = 'none';
            formPaypal.style.display = 'block';
            metodoPago.value = 'paypal';

            formTarjeta.querySelectorAll('input').forEach(input => input.required = false);
            formPaypal.querySelectorAll('input').forEach(input => input.required = true);
        });
    </script>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>