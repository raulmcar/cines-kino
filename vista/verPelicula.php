<?php
    session_start();
    require_once('../modelo/pelicula.php');
    require_once('../modelo/sesion.php');
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

    <?php
        if (!isset($_SESSION['peliculaElegida'])){
            $_SESSION['peliculaElegida'] = Pelicula::getPeliculaById($_POST['id_peli']);
        }
    ?>

    <div class="container py-5 bg-secondary bg-gradient rounded my-5">
        <div class="row">
            <div class="col-md-4">
                <img src="../imagenes/carteles/<?php $_SESSION['peliculaElegida']['titulo'] ?>.jpg" 
                alt="<?php $_SESSION['peliculaElegida']['titulo'] ?>" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-md-8">
                <h1 class="text-warning"><?php $_SESSION['peliculaElegida']['titulo'] ?></h1>
                <p class="text-muted"><?php $_SESSION['peliculaElegida']['sinopsis'] ?></p>

                <ul class="list-unstyled">
                    <li><strong>Duración:</strong> <?php $_SESSION['peliculaElegida']['duracion'] ?> minutos</li>
                    <li><strong>Clasificación:</strong> +<?php $_SESSION['peliculaElegida']['clasificacion'] ?></li>
                    <li><strong>Género:</strong> <?php $_SESSION['peliculaElegida']['genero'] ?></li>
                </ul>
            </div>
        </div>

        <hr class="my-4"> 

        <form method="POST" action="" class="mb-3 w-50 mx-auto">
            <h3 for="fecha" class="form-label text-warning text-center">Selecciona una fecha para ver las sesiones:</h3>
            <input type="date" id="fecha" name="fecha" value="<?php $fechaSeleccionada ?>" class="form-control" />
            <button type="submit" class="btn btn-outline-warning mt-2">Ver sesiones</button>
        </form>

        <?php
            if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
                $fechaSeleccionada = $_POST['fecha'];
                $sesiones = Sesion::getSesionesById($_SESSION['peliculaElegida']['id_pelicula'], $fechaSeleccionada);
            } else {
                $fechaSeleccionada = '';
                $sesiones = [];
            }

            if (!empty($sesiones)) {
                echo "<div class='row'>";
                $sesionesAgrupadas = [];
                foreach ($sesiones as $sesion) {
                    $sala = $sesion['id_sala'];
                    $sesionesAgrupadas[$sala][] = $sesion;
                }

                foreach ($sesionesAgrupadas as $sala => $sesionesDeLaSala) {
                    echo "<h4 class='mt-4 text-warning'>Sala $sala</h4>";
                    echo "<div class='d-flex flex-wrap gap-2 mb-4'>";
                    foreach ($sesionesDeLaSala as $sesion) {
                        $hora = date('H:i', strtotime($sesion['fecha_hora']));
                        echo "
                            <form method='POST' action='/cine/vista/reservarAsiento.php'>
                                <input type='hidden' name='id_sesion' value='{$sesion['id_sesion']}'>
                                <button type='submit' class='btn btn-outline-warning'>$hora</button>
                            </form>
                        ";
                    }
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No hay sesiones disponibles para la fecha seleccionada.</p>";
            }
        ?>
    </div>


    <?php include '../include/footer.php'; ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>