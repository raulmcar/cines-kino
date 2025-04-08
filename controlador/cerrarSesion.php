<?php
    session_start();
    session_destroy();
    session_start();
    $_SESSION['msg'] = "Sesión cerrada correctamente.";
    header('Location: ../index.php');
    exit;
?>