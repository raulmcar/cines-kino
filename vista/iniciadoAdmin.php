<?php
    session_start();

    if (!isset($_SESSION['user'])){
        $_SESSION['msg'] = "Necesitas iniciar sesión para entrar aquí.";
        header('Location: ../index.php');
        exit();
    } else {
        if ($_SESSION['user']['tipo_usuario'] !== 'admin'){
            $_SESSION['msg'] = "NO ESTAS AUTORIZADO PARA ENTRAR AQUI. SE PROCEDERÁ A LLAMAR A LAS AUTORIDADES COMPETENTES PARA SU SANCIÓN.";
            header('Location: ../index.php');
            exit();
        }
    }
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
<body class="d-flex flex-column min-vh-100"> <!-- VER PORQUE SALE LA OPCION DE HACER SCROLL HORIZONTAL -->
    <?php include '../include/navbar.php'; ?>

    <div class="row d-flex justify-content-center mt-5 mb-5">
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
        <img src="../imagenes/agregarSesion.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Crear sesión</h5>
                <p class="card-text text-center">Con esta opción puedes añadir o modificar las sesiones del cine.</p>
                <a href="./registrarSesion.php" class="btn btn-primary mt-4">Registrar nueva sesión</a>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-2 mb-5">
    <div class="card m-2" style="width: 18rem;">
        <img src="../imagenes/gestionarUsuarios.jpg" class="card-img-top mt-2" alt="">
            <div class="card-body text-center">
                <h5 class="card-title text-center">Administrar usuarios</h5>
                <p class="card-text text-center">Con esta opción puedes modificar datos de los usuarios.</p>
                <a href="./gestionarUsuarios.php" class="btn btn-primary mt-4">Gestionar usuarios</a>
            </div>
        </div>
    </div>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>

    <?php include '../include/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>