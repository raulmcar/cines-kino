<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['id_usuario_hidden']) && !empty($_POST['id_usuario_hidden'])){
            require_once('../modelo/usuario.php');

            if (Usuario::eliminarUsuario($_POST['id_usuario_hidden'])){
                $_SESSION['msg'] = "El usuario se ha eliminado con exito.";
                unset($_SESSION['AllUsers']);
                header('Location: ../vista/gestionarUsuarios.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error al eliminar el usuario.";
                header('Location: ../vista/gestionarUsuarios.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Alguno de los datos introducidos no es correcto.";
            heafer('Location: ../vista/gestionarUsuarios.php');
            exit();
        }
    }
?>