<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nombreSala'], $_POST['capacidad']) && !empty($_POST['nombreSala']) && !empty($_POST['capacidad'])){
            require_once('../modelo/sala.php');

            $sala = new Sala($_POST['nombreSala'], $_POST['capacidad']);

            if ($sala->comprobarSala($_POST['nombreSala'])) {
                $_SESSION['msg'] = "La sala está ya registrada";
                header('Location: ../vista/gestionarSalas.php');
                exit();
            }

            if ($sala->registrarSala()) {
                $_SESSION['msg'] = "Registro completado";
                header('Location: ../vista/gestionarSalas.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error en el registro de la sala";
                header('Location: ../vista/gestionarSalas.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Falta alguno de los datos";
            header('Location: ../vista/gestionarSalas.php');
            exit();
        }
    }
?>