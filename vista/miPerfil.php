<?php
    session_start();

    if (!isset($_SESSION['user'])){
        $_SESSION['msg'] = "Necesitas iniciar sesión para entrar aquí.";
        header('Location: ../index.php');
        exit();
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
<body>
    <nav class="navbar bg-black bg-gradient">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="../index.php">
                <img src="../imagenes/logo.png" alt="Bootstrap" width="110" height="80">
            </a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Cartelera</a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Foro</a>
        <div class="dropdown">
            <button class="btn btn-primary text-white rounded-circle dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill fs-3"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg" style="width: 250px;">
                <?php
                    if (isset($_SESSION['user'])){
                        if($_SESSION['user']['tipo_usuario'] == 'admin'){
                            echo "<a href='./controlador/cerrarSesion.php' class='btn btn-dark w-100'>Cerrar sesión</a>";
                            echo "<a href='./vista/iniciadoAdmin.php' class='btn btn-dark w-100'>Zona administrador</a>";
                        } else {
                            echo "<a href='./controlador/cerrarSesion.php' class='btn btn-dark w-100'>Cerrar sesión</a>";
                        }
                    } else {
                        echo "<h6 class='text-center fw-bold'>Iniciar Sesión</h6>
                                <form action='./controlador/autenticacion.php' method='post'>
                                    <div class='mb-2'>
                                        <label for='email' class='form-label'>Correo electrónico</label>
                                        <input type='email' class='form-control' name='email'>
                                    </div>
                                    <div class='mb-2'>
                                        <label for='password' class='form-label'>Contraseña</label>
                                        <input type='password' class='form-control' name='contrasena'>
                                    </div>
                                    <button type='submit' class='btn btn-dark w-100'>Entrar</button>
                                </form>
                                <p class='text-center mb-0 mt-1'>
                                    <a href='./vista/registrarUsuario.php' class='text-decoration-none'>¿No tienes cuenta? Regístrate</a>
                                </p>";
                    }
                ?>
            </div>
        </div>
        </div>
    </nav>

    <?php echo "<h2 class='text-warning'>Bienvenido a tu zona personal " . $_SESSION['user']['email'] . "</h2>"; ?>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>