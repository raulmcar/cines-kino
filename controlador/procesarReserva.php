<?php
    session_start();
    require_once('../modelo/usuario.php');
    require_once('../modelo/reserva.php');
    require_once('../modelo/reserva_asiento.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!isset($_SESSION['user'])){
            if (isset($_POST['correo_reserva'], $_POST['contrasena_reserva'])){

                $usuario = Usuario::iniciarSesion($_POST['correo_reserva'], $_POST['contrasena_reserva']);

                if (!$usuario){
                    $_SESSION['msg'] = "Ha habido un problema a la hora de inciar sesión";
                    header('Location: ../vista/pagarReserva.php');
                    exit();
                } else {
                    $totalCompra = count($_SESSION['asientosElegidos']) * 8.15;
                    $fecha_reserva = date('Y-m-d H:i:s'); 

                    $reserva = new Reserva($_SESSION['user']['id_usuario'], $_SESSION['sesionElegida']['id_sesion'], $totalCompra, $fecha_reserva);
                    $reserva->crearReserva();
                    $id_reserva = $reserva->getIdReserva();
                    
                    foreach($_SESSION['asientosElegidos'] as $asiento){
                        $reservaAsiento = new ReservaAsiento($id_reserva, $asiento['id_asiento']);
                        $reservaAsiento->crearReservaAsiento();
                    }

                    header('Location: ../vista/procesandoCompra.php');
                    exit();
                }
            }
        } else {
            $totalCompra = count($_SESSION['asientosElegidos']) * 8.15;
            $fecha_reserva = date('Y-m-d H:i:s'); 

            $reserva = new Reserva($_SESSION['user']['id_usuario'], $_SESSION['sesionElegida']['id_sesion'], $totalCompra, $fecha_reserva);
            $reserva->crearReserva();
            $id_reserva = $reserva->getIdReserva();
                    
            foreach($_SESSION['asientosElegidos'] as $asiento){
                $reservaAsiento = new ReservaAsiento($id_reserva, $asiento['id_asiento']);
                $reservaAsiento->crearReservaAsiento();
            }

            header('Location: ../vista/procesandoCompra.php');
            exit();
        }
    }
?>