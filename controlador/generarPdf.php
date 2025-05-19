<?php
    session_start();
    require_once('../include/modeloPdf.php');

    if (!isset($_SESSION['peliculaElegida'], $_SESSION['sesionElegida'], $_SESSION['asientosElegidos'])){
        $_SESSION['msg'] = "Faltan datos para generar la entrada en PDF";
        header('Location: ./cine/index.php');
        exit();
    } 

    $datosReserva = [
        'titulo' => $_SESSION['peliculaElegida']['titulo'],
        'sala' => $_SESSION['sesionElegida']['id_sala'],
        'fecha' => date('d-m-Y H:i', strtotime($_SESSION['sesionElegida']['fecha_hora'])),
        'precioTotal' => count($_SESSION['asientosElegidos']) * 8.15,
        'imagenCartel' => '../imagenes/carteles/' . $_SESSION['peliculaElegida']['titulo'] . '.jpg',
        'asientosElegidos' => $_SESSION['asientosElegidos']
    ];

    generarEntradaPdf($datosReserva);
?>