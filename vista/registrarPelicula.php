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
<body>
    <?php include '../include/navbar.php'; ?>

    <div class="container w-100 d-flex justify-content-center rounded mb-5">
        <form id="formulario" class="col-6 mt-5 p-3 rounded bg-dark-subtle bg-gradient text-dark" enctype="multipart/form-data" action="../controlador/registrarPelicula.php" method="post">
            <div class="mb-2">
                <label class="form-label">Nombre de la película</label>
                <input type="text" name="nombrePeli" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Sinopsis</label>
                <input type="text" name="sinopsis" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Duración</label>
                <input type="number"  name="duracion" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Género</label>
                <input type="text" name="genero" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Clasificación</label>
                <input type="number" name="clasificacion" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Cartel de la película</label>
                <input type="file" name="cartelPeli" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Director</label>
                <input type="text" name="director" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Año de estreno</label>
                <input type="number" name="anio" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label" for="estreno">¿Estreno?</label>
                <select name="estreno" id="estreno" class="form-select">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary text-center mt-2">Regsitrar pelicula</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>