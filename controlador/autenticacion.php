<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['email'], $_POST['contrasena']) && !empty($_POST['email']) && !empty($_POST['contrasena'])){
            require_once('../modelo/usuario.php');

            $usuario = Usuario::iniciarSesion($_POST['email'], $_POST['contrasena']);

            if ($usuario){
                if ($usuario['tipo_usuario'] == 'user'){
                    $_SESSION['usuario'] = $_POST['email'];
                    $_SESSION['msg'] = "Inición sesiada";
                    header('Location: ../vista/iniciadoUsuario.php');
                    exit();
                } elseif ($usuario['tipo_usuario'] == 'admin'){
                    $_SESSION['usuario'] = $_POST['email'];
                    $_SESSION['msg'] = "Inición sesiada";
                    header('Location: ../vista/iniciadoAdmin.php');
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Ha habido un problema a la hora de inciar sesión";
                header('Location: ../index.php');
                exit();
            }
        }
    }
?>