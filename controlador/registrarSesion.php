<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['peli'], $_POST['sala'], $_POST['fechaSesion']) && !empty($_POST['peli']) 
        && !empty($_POST['sala']) && !empty($_POST['fechaSesion'])){
            require_once('../modelo/sesion.php');
            $fechaFormateada = date('Y-m-d H:i:s', strtotime($_POST['fechaSesion']));

            $sesion = new Sesion($_POST['peli'], $_POST['sala'], $fechaFormateada);

            if ($sesion->registrarSesion()){
                $_SESSION['msg'] = "La sesion se ha registrado con exito";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error en el registro de la sesión";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Falta alguno de los datos";
            header('Location: ../vista/registrarSesion.php');
            exit();
        }
    }
?>