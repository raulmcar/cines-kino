<?php
    session_start();
    require_once('../modelo/usuario.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['correo_reserva'], $_POST['contrasena_reserva'])){

            $usuario = Usuario::iniciarSesion($_POST['correo_reserva'], $_POST['contrasena_reserva']);

            if (!$usuario){
                $_SESSION['msg'] = "Ha habido un problema a la hora de inciar sesión";
                header('Location: ../vista/pagarReserva.php');
                exit();
            } else {
                
            }
        }
    } else {

    }

?>