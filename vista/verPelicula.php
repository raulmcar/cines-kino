<?php
    session_start();
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

    <?php
        require_once('../modelo/pelicula.php');
        $pelicula = Pelicula::getPeliculaById($_POST['id_peli']);
    ?>

    <div class="container py-5 bg-secondary bg-gradient rounded my-5">
        <div class="row">
            <div class="col-md-4">
                <img src="../imagenes/carteles/<?= $pelicula['titulo'] ?>.jpg" alt="<?= $pelicula['titulo'] ?>" class="img-fluid rounded shadow-lg">
            </div>

            <div class="col-md-8">
                <h1 class="text-warning"><?= $pelicula['titulo'] ?></h1>
                <p class="text-muted"><?= $pelicula['sinopsis'] ?></p>

                <ul class="list-unstyled">
                    <li><strong>Duración:</strong> <?= $pelicula['duracion'] ?> minutos</li>
                    <li><strong>Clasificación:</strong> +<?= $pelicula['clasificacion'] ?></li>
                    <li><strong>Género:</strong> <?= $pelicula['genero'] ?></li>
                </ul>
            </div>
        </div>

        <hr class="my-4"> <!-- RETOCAR A PARTIR DE AQUI -->

        <?php
            require_once('../modelo/sesion.php');
            $sesiones = Sesion::getSesionesById($_POST['id_peli']);
        ?>

        <h3 class="mb-3 text-warning">Sesiones disponibles</h3>
        <div class="row">
            <?php foreach ($sesiones as $sesion): ?>
                <div class="col-md-2 col-4 mb-3">
                    <form method="POST" action="">
                        <input type="hidden" name="id_sesion" value="<?= $sesion['id_sesion'] ?>">
                        <input type="hidden" name="id_peli" value="<?= $pelicula['id_pelicula'] ?>">
                        <button class="btn btn-outline-warning w-100"><?= date('H:i', strtotime($sesion['fecha_hora'])) ?></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <?php include '../include/footer.php'; ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>