<?php
    session_start();

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

    <div class="container mt-5 bg-secondary bg-gradient rounded p-4 text-warning" style="--bs-bg-opacity: .9; width: 70rem;">
        <h2 class="text-center">Contáctanos</h2>
        <p class="text-center">Si tienes alguna duda, sugerencia o tienes un problema, escríbenos y nos pondremos en contacto contigo lo antes posible.</p>
            <form action="/cine/controlador/contactanos.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Tu nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Tu correo electrónico</label>
                    <input type="email" class="form-control" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" name="mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-50 mx-auto d-block">Enviar</button>
            </form>
    </div>


    <?php include '../include/footer.php'; ?>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>