<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['sala'], $_POST['fila'], $_POST['numero']) && !empty($_POST['sala']) && !empty($_POST['fila']) && !empty($_POST['numero'])) {
            require_once('../modelo/asiento.php');

            $asiento = new Asiento($_POST['sala'], $_POST['fila'], $_POST['numero']);

            if ($asiento->registrarAsiento()){
                $_SESSION['msg'] = "Registro completado";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error al registrar el asiento";
                header('Location: ../vista/iniciadoAdmin.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Falta alguno de los datos";
            header('Location: ../vista/registrarAsiento.php');
            exit();
        }
    }





?>