<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['id_usuario_hidden'], $_POST['newnombre'], $_POST['newapellidos'], $_POST['newemail'], 
            $_POST['newtipo_usuario']) && !empty($_POST['id_usuario_hidden']) && !empty($_POST['newnombre']) 
            && !empty($_POST['newapellidos']) && !empty($_POST['newemail']) && !empty($_post['newtipo_usuario'])){
            require_once('../modelo/usuario.php');

            if (Usuario::actualizarUsuario($_POST['id_usuario_hidden'], $_POST['newnombre'], $_POST['newapellidos'], 
            $_POST['newemail'], $_POST['newtipo_usuario'])){
                $_SESSION['msg'] = "El usuario se ha actualizado correctamente.";
                unset($_SESSION['AllUsers']);
                header('Location: ../vista/gestionarUsuarios.php');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error al actualizar el usuario.";
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