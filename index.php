<?php
    session_start();
    require_once('./modelo/pelicula.php');

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

<style>
    .zoom-img {
        transition: transform 0.4s ease-in-out;
    }

    .zoom-img:hover {
        transform: scale(1.1);
        z-index: 1;
        position: relative;
    }
</style>

</head>
<body class="d-flex flex-column min-vh-100">
    <?php include './include/navbar.php'; ?>

    <?php $pelis = Pelicula::desplegarPeliculas(); ?>

    <div class="draggable mt-4">
        <div class="min-vh-75">
            <div class="container bg-secondary bg-gradient rounded p-4" style="--bs-bg-opacity: .7;">
                <div class="row">
                    <div class="col-lg-4 my-auto">
                        <h1 class="text-gradient text-warning mb-0">LOS ÚLTIMOS</h1>
                        <h1 class="mb-4">ESTRENOS</h1>
                        <p class="lead">Disfruta del cine actual en tus salas de cine favoritas y de la última tecnología en pantallas y sonido.</p>
                        <div class="buttons">
                            <a href="/cine/vista/cartelera.php" class="btn text-warning bg-dark bg-gradient mt-4 shadow-lg">CARTELERA</a> 
                        </div>
                    </div>

                    <div class="col-lg-8 ps-5 pe-0">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <?php
                                if (isset($pelis[0])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-0">
                                        <input type="hidden" name="id_peli" value="' . $pelis[0]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 mt-5 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[0]['titulo'] . '.jpg" alt="' . $pelis[0]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button> 
                                    </form>';
                                }
                                ?>
                            </div>

                            <div class="col-lg-3 col-6">
                                <?php
                                if (isset($pelis[1])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-0">
                                        <input type="hidden" name="id_peli" value="' . $pelis[1]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[1]['titulo'] . '.jpg" alt="' . $pelis[1]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }

                                if (isset($pelis[2])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-4">
                                        <input type="hidden" name="id_peli" value="' . $pelis[2]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[2]['titulo'] . '.jpg" alt="' . $pelis[2]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }
                                ?>
                            </div>

                            <div class="col-lg-3 col-6">
                                <?php
                                if (isset($pelis[3])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-0 mt-lg-5">
                                        <input type="hidden" name="id_peli" value="' . $pelis[3]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[3]['titulo'] . '.jpg" alt="' . $pelis[3]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }

                                if (isset($pelis[4])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-4">
                                        <input type="hidden" name="id_peli" value="' . $pelis[4]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[4]['titulo'] . '.jpg" alt="' . $pelis[4]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }
                                ?>
                            </div>

                            <div class="col-lg-3 col-6">
                                <?php
                                if (isset($pelis[5])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-3">
                                        <input type="hidden" name="id_peli" value="' . $pelis[5]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[5]['titulo'] . '.jpg" alt="' . $pelis[5]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }

                                if (isset($pelis[6])) {
                                    echo '<form method="POST" action="./vista/verPelicula.php" class="mt-4">
                                        <input type="hidden" name="id_peli" value="' . $pelis[6]['id_pelicula'] . '">
                                        <button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg">
                                            <img class="w-100 border-radius-lg shadow rounded zoom-img" src="./imagenes/carteles/' . $pelis[6]['titulo'] . '.jpg" alt="' . $pelis[6]['titulo'] . '" style="height: 300px; object-fit: cover;">
                                        </button>
                                    </form>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>

    <?php include './include/footer.php'; ?>

<script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>