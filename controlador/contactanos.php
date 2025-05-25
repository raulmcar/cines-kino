<?php
    session_start();
    require_once('../servicios/contactanosMailer.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nombre'], $_POST['correo'], $_POST['mensaje']) && !empty($_POST['nombre']) 
        && !empty($_POST['correo']) && !empty($_POST['mensaje'])){
            
            if(enviarCorreoContacto($_POST['nombre'], $_POST['correo'], $_POST['mensaje'])){
                $_SESSION['msg'] = 'El mensaje ha sido enviado con éxito. En breves momentos un administrador se pondrá en contacto contigo.';
                header('Location: ../vista/contactanos.php');
                exit();
            } else {
                $_SESSION['msg'] = 'Ha habido un error a la hora de enviar el mensaje.';
                header('Location: ../vista/contactanos.php');
                exit();
            }
        }
    }
?>