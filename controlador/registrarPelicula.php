<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nombrePeli'], $_POST['sinopsis'], $_POST['duracion'], $_POST['genero'], $_POST['clasificacion'], 
        $_FILES['cartelPeli'], $_POST['director'], $_POST['anio'], $_POST['estreno']) && !empty($_POST['nombrePeli']) && !empty($_POST['sinopsis']) && !empty($_POST['duracion']) 
        && !empty($_POST['genero']) && !empty($_POST['clasificacion']) && !empty($_FILES['cartelPeli']) && !empty($_POST['director'])
        && !empty($_POST['anio']) && !empty($_POST['estreno'])){
            require_once('../modelo/pelicula.php');

            $directorio_subida = "../imagenes/carteles/";
            $extension = explode(".", $_FILES['cartelPeli']['name']);
            $fichero_subido = $directorio_subida.$_POST['nombrePeli'].".".$extension[count($extension) - 1];
            move_uploaded_file($_FILES['cartelPeli']['tmp_name'], $fichero_subido);

            $pelicula = new Pelicula($_POST['nombrePeli'], $_POST['sinopsis'], $_POST['duracion'], $_POST['genero'], 
            $_POST['clasificacion'], $fichero_subido, $_POST['director'], $_POST['anio'], $_POST['estreno']);

            if ($pelicula->comprobarPelicula($_POST['nombrePeli'])) {
                $_SESSION['msg'] = "La pelicula está ya registrada";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            }

            if ($pelicula->registrarPelicula()) {
                $_SESSION['msg'] = "Registro completado";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error en el registro de la pelicula";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Falta alguno de los datos";
            header('Location: ../vista/registrarPelicula.php');
            exit();
        }
    }
?>