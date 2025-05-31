<?php
session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_pelicula_hidden'], $_POST['nombre_pelicula_hidden'], $_POST['newnombre'], $_POST['newduracion'], $_POST['newgenero'], $_POST['newdirector']) &&
            !empty($_POST['id_pelicula_hidden']) && !empty($_POST['newnombre']) && !empty($_POST['newduracion']) &&
            !empty($_POST['newgenero']) && !empty($_POST['newdirector'])) {
            require_once('../modelo/pelicula.php');

            if (Pelicula::actualizarPelicula($_POST['id_pelicula_hidden'], $_POST['newnombre'], $_POST['newduracion'], $_POST['newgenero'], $_POST['newdirector'])) {
                $rutaCartel = '../imagenes/carteles/' . $_POST['nombre_pelicula_hidden'] . '.jpg';
                $rutaNueva = '../imagenes/carteles/' . $_POST['newnombre'] . '.jpg';
                
                if (file_exists($rutaCartel)) {
                    rename($rutaCartel, $rutaNueva);
                }

                $_SESSION['msg'] = "La película se ha actualizado correctamente.";
                header('Location: ../vista/gestionarPeliculas.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error al actualizar la película.";
                header('Location: ../vista/gestionarPeliculas.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Alguno de los datos introducidos no es correcto.";
            header('Location: ../vista/gestionarPeliculas.php');
            exit();
        }
    }
?>
