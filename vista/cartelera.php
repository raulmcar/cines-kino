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
    <style>
        .zoom-img {
            transition: transform 0.3s ease;
            }

        button:hover .zoom-img {
            transform: scale(1.05);
            }

        .overlay-title {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            }

        button:hover .overlay-title {
            opacity: 1;
            }
    </style>
</head>
<body>
    <?php include '../include/navbar.php'; ?>

    <?php $pelis = Pelicula::desplegarPeliculas(); ?>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">

    <?php
        for ($i = 0; $i < count($pelis); $i++) {
            $id = $pelis[$i]['id_pelicula'];
            $titulo = htmlspecialchars($pelis[$i]['titulo']);

            echo '<div class="col">';
            echo    '<form method="POST" action="./verPelicula.php" class="mt-0">';
            echo     '<input type="hidden" name="id_peli" value="' . $id . '">';
            echo     '<button type="submit" class="p-0 border-0 bg-transparent w-100 shadow-lg position-relative">';
            echo       '<img src="../imagenes/carteles/' . $titulo . '.jpg" alt="' . $titulo . '"';
            echo            'class="w-100 border-radius-lg shadow rounded zoom-img"';
            echo            'style="height: 300px; object-fit: cover;">';
            echo       '<div class="overlay-title position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">';
            echo         '<span class="text-white bg-dark bg-opacity-75 px-3 py-2 rounded fw-bold">' . $titulo . '</span>';
            echo       '</div>';
            echo     '</button>';
            echo   '</form>';
            echo '</div>';
        }
    ?>
        </div>
    </div>
    

    <?php include '../include/footer.php'; ?>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>