<?php
session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_pelicula_hidden'], $_POST['nombre_pelicula_hidden']) 
            && !empty($_POST['id_pelicula_hidden']) && !empty($_POST['nombre_pelicula_hidden'])) {

            require_once('../modelo/pelicula.php');

            $idPelicula = $_POST['id_pelicula_hidden'];
            $nombrePelicula = $_POST['nombre_pelicula_hidden'];

            if (Pelicula::eliminarPelicula($idPelicula)) {

                $rutaCartel = '../imagenes/carteles/' . $nombrePelicula . '.jpg';

                if (file_exists($rutaCartel)) {
                    unlink($rutaCartel);
                }

                $_SESSION['msg'] = "La película se ha eliminado correctamente.";
            } else {
                $_SESSION['msg'] = "Ha habido un error al eliminar la película.";
            }

            header('Location: ../vista/gestionarPeliculas.php');
            exit();
        } else {
            $_SESSION['msg'] = "No se han recibido los datos necesarios para eliminar la película.";
            header('Location: ../vista/gestionarPeliculas.php');
            exit();
        }
    } else {
        header('Location: ../vista/gestionarPeliculas.php');
        exit();
    }
?>
