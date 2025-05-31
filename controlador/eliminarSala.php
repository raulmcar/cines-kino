<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_sala_hidden']) && !empty($_POST['id_sala_hidden'])) {

            require_once('../modelo/sala.php');
            $idSala = $_POST['id_sala_hidden'];

            if (Sala::eliminarSala($idSala)) {
                $_SESSION['msg'] = "La sala se ha eliminado correctamente.";
            } else {
                $_SESSION['msg'] = "Error al eliminar la sala.";
            }
        } else {
            $_SESSION['msg'] = "No se recibieron datos para eliminar la sala.";
        }
        header('Location: ../vista/gestionarSalas.php');
        exit();
    } else {
        header('Location: ../vista/gestionarSalas.php');
        exit();
    }
?>
