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

    .carousel-inner img {
        height: 500px; 
        object-fit: cover;
    }
</style>

</head>
<body class="d-flex flex-column min-vh-100">

    <?php include './include/navbar.php'; ?>

    <?php $pelis = Pelicula::desplegarEstrenos(); ?>

    <div class="container-fluid mt-4">
        <div id="carruselInicio" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 1400px;">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="/cine/imagenes/imgcarrusel/imagen3.png" class="d-block w-100 img-fluid" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="/cine/imagenes/imgcarrusel/imagen2.png" class="d-block w-100 img-fluid" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="/cine/imagenes/imgcarrusel/imagen1.png" class="d-block w-100 img-fluid" alt="Slide 3">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carruselInicio" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselInicio" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carruselInicio" data-bs-slide-to="2"></button>
            </div>
        </div>
    </div>
    
    <div class="draggable mt-4">
        <div class="min-vh-75">
            <div class="container bg-secondary bg-gradient rounded p-4 mb-4" style="--bs-bg-opacity: .7;">
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

<div class="container mt-5 mb-5">
    <div class="row g-4 justify-content-around">
        <div class="col-md-6 p-5">
            <div class="row align-items-center shadow rounded p-4 bg-secondary bg-gradient" style="--bs-bg-opacity: .7; height: 100%;">
                <div class="col-md-6">
                    <img src="/cine/imagenes/imgindex/imag1index.png" alt="Imagen promocional del cine" class="img-fluid rounded" style="width: 250px; height: 250px; object-fit: cover;">
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <h2 class="mb-3 text-gradient text-warning">¡Vive la magia del cine!</h2>
                    <p class="lead">
                        Sumérgete en la mejor experiencia cinematográfica con la última tecnología en imagen y sonido.
                        <strong>¡Te esperamos con las palomitas listas!</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 p-5">
            <div class="row align-items-center shadow rounded p-4 bg-secondary bg-gradient" style="--bs-bg-opacity: .7; height: 100%;">
                <div class="col-md-6">
                    <img src="/cine/imagenes/imgindex/imag2index.png" alt="Imagen de snacks y bebidas" class="img-fluid rounded" style="width: 250px; height: 250px; object-fit: cover;">
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <h2 class="mb-3 text-gradient text-warning">Snacks irresistibles</h2>
                    <p class="lead">
                        Desde palomitas recién hechas hasta bebidas refrescantes. ¡Haz que tu visita al cine sea completa con nuestras deliciosas opciones de snacks!
                        <strong>¡Disfruta cada momento!</strong>
                    </p>
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