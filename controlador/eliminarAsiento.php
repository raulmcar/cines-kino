<?php
    session_start();
    require_once('../modelo/asiento.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_asiento'])) {
            $id = $_POST['id_asiento'];

            if (Asiento::eliminarAsiento($id)) {
                $_SESSION['msg'] = "Asiento eliminado con éxito.";
                header('Location: ../vista/gestionarAsientos.php?eliminado=1');
                exit();
            } else {
                $_SESSION['msg'] = "Ha habido un error a la hora de eliminar un asiento.";
                header('Location: ../vista/gestionarAsientos.php?error=1');
                exit();
            }
        }
    }
    header('Location: ../vista/gestionarAsientos.php');
    exit();
?>
