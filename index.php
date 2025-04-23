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
    <?php include './include/navbar.php'; ?>

    <?php
        require_once('./modelo/pelicula.php');
        $pelis = Pelicula::desplegarPeliculas();

        if(!empty($pelis)){
            echo "<div class='container py-5'>";
            echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4'>";
            foreach($pelis as $peli){
                echo "<div class='col'>";
                echo "<div class='card h-100 shadow-sm border border-0 border-rounded shadow-lg'>";
                echo "<div class='shadow-lg' style='height: 420px; overflow: hidden;'>";
                echo "<img src='./imagenes/carteles/" . $peli['titulo'] . ".jpg' class='card-img-top rounded' style='object-fit: cover; height:420px;'>";
                echo "</div>";
                echo "<a href='#' class='btn btn-dark shadow-lg' style='position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); width: 90%;'>Ver sesiones</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p class='text-warning'>No hay pelculas registradas</p>";
        }
    ?>

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