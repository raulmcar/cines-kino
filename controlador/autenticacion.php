<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['email'], $_POST['contrasena']) && !empty($_POST['email']) && !empty($_POST['contrasena'])){
            require_once('../modelo/usuario.php');

            $usuario = Usuario::iniciarSesion($_POST['email'], $_POST['contrasena']);

            if ($_SESSION['user']){
                if ($_SESSION['user']['tipo_usuario'] == 'user'){
                    $_SESSION['msg'] = "Sesión iniciada.";
                    header('Location: ../index.php');
                    exit();
                } elseif ($_SESSION['user']['tipo_usuario'] == 'admin'){
                    $_SESSION['msg'] = "Sesión iniciada.";
                    header('Location: ../vista/iniciadoAdmin.php');
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Ha habido un problema a la hora de inciar sesión";
                header('Location: ../index.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Faltan datos para iniciar sesión.";
            header('Location: ../index.php');
            exit();
        }
    }
?>