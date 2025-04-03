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
    <link rel="stylesheet" href="../css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-black bg-gradient" style="--bs-bg-opacity: .5;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="../index.php">
                <img src="../imagenes/logo.png" alt="Bootstrap" width="110" height="80">
            </a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Cartelera</a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Foro</a>
            <p class="text-light m-2"><?php echo "Bienvenido administrador: " . $_SESSION['usuario']; ?></p>
            <div class="dropdown">
                <button class="btn btn-primary text-white rounded-circle dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill fs-3"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg" style="width: 250px;">
                    <a href="../index.php" class="btn btn-dark w-100">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="row d-flex justify-content-center mt-5">
        <div class="card m-2" style="width: 18rem;">
        <img src="../imagenes/agregar.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Añadir peliculas</h5>
                <p class="card-text text-center">Con esta opción puedes añadir o modificar las peliculas que entren o salgan de la cartelera.</p>
                <a href="./registrarPelicula.php" class="btn btn-primary">Registrar nueva pelicula</a>
            </div>
        </div>
        <div class="card m-2" style="width: 18rem;">
        <img src="../imagenes/agregarSala.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Añadir salas</h5>
                <p class="card-text text-center">Con esta opción puedes añadir o modificar las salas del cine.</p>
                <a href="./registrarSala.php" class="btn btn-primary mt-4">Registrar nueva sala</a>
            </div>
        </div>
        <div class="card m-2" style="width: 18rem;">
        <img src="../imagenes/agregarAsiento.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Añadir asientos</h5>
                <p class="card-text text-center">Con esta opción puedes añadir o modificar los asientos de las salas de cine.</p>
                <a href="./registrarAsiento.php" class="btn btn-primary mt-4">Registrar nuevo asiento</a>
            </div>
        </div>
        <div class="card m-2" style="width: 18rem;">
        <img src="../imagenes/agregarAsiento.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Crear sesión</h5>
                <p class="card-text text-center">Con esta opción puedes añadir o modificar las sesiones del cine.</p>
                <a href="./registrarSesion.php" class="btn btn-primary mt-4">Registrar nueva sesión</a>
            </div>
        </div>
    </div>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>