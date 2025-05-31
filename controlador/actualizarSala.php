<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_sala_hidden'], $_POST['newnombre']) &&
            !empty($_POST['id_sala_hidden']) && !empty($_POST['newnombre'])) {

            require_once('../modelo/sala.php');

            $idSala = $_POST['id_sala_hidden'];
            $nuevoNombre = $_POST['newnombre'];

            if (Sala::actualizarSala($idSala, $nuevoNombre)) {
                $_SESSION['msg'] = "La sala se ha actualizado correctamente.";
            } else {
                $_SESSION['msg'] = "Error al actualizar la sala.";
            }
        } else {
            $_SESSION['msg'] = "Datos incompletos para actualizar la sala.";
        }
        header('Location: ../vista/gestionarSalas.php');
        exit();
    } else {
        header('Location: ../vista/gestionarSalas.php');
        exit();
    }
?>
