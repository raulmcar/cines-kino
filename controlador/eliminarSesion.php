<?php
    session_start();
    require_once('../modelo/sesion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_sesion']) && !empty($_POST['id_sesion'])) {
            $idSesion = $_POST['id_sesion'];

            if (Sesion::eliminarSesion($idSesion)) {
                $_SESSION['msg'] = "La sesión se ha eliminado correctamente.";
            } else {
                $_SESSION['msg'] = "Error al eliminar la sesión.";
            }
        } else {
            $_SESSION['msg'] = "No se recibió el ID de la sesión para eliminar.";
        }
    } else {
        $_SESSION['msg'] = "Método no permitido.";
    }

    header('Location: ../vista/gestionarSesiones.php');
    exit();
?>