<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['contrasena'], $_POST['contrasena2'], $_POST['telefono'], 
        $_POST['dni'], $_POST['fecha_nacimiento']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['email']) 
        && !empty($_POST['contrasena']) && !empty($_POST['contrasena2']) && !empty($_POST['telefono']) && !empty($_POST['dni']) 
        && !empty($_POST['fecha_nacimiento'])){
            if ($_POST['contrasena'] == $_POST['contrasena2']){
                require_once('../modelo/usuario.php');

                $usuario = new Usuario($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['contrasena'], $_POST['telefono'], 
                $_POST['dni'], $_POST['fecha_nacimiento'], "user");

                if ($usuario->comprobarCorreo($_POST['email'])) {
                    $_SESSION['msg'] = "El correo electrónico ya está registrado";
                    header('Location: ../index.php');
                    exit();
                } 

                if ($usuario->registrarUsuario()) {
                    $_SESSION['msg'] = "Registro completado";
                    header('Location: ../index.php');
                    exit();
                } else {
                    $_SESSION['msg'] = "Ha habido un error en el registro de usuario";
                    header('Location: ../index.php');
                    exit();
                }

            } else {
                $_SESSION['msg'] = "Las contraseñas no coinciden";
                header('Location: ../index.php');
                exit();
            }

        } else {
            $_SESSION['msg'] = "Falta alguno de los datos.";
            header('Location: ../index.php');
            exit();
        }
    }
?>