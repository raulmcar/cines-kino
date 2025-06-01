<?php
    session_start();
    require_once('../modelo/usuario.php');
    require_once('../modelo/reserva.php');
    require_once('../modelo/reserva_asiento.php');
    require_once('../servicios/modeloPdfMailer.php');
    require_once('../servicios/modeloMailer.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!isset($_SESSION['user'])){
            if (!empty($_POST['correo_reserva']) && !empty($_POST['contrasena_reserva'])) {

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
                    $id_reserva = $reserva->getId();
                    
                    foreach($_SESSION['asientosElegidos'] as $asiento){
                        $reservaAsiento = new ReservaAsiento($id_reserva, $asiento['id_asiento']);
                        $reservaAsiento->crearReservaAsiento();
                    }

                    header('Location: ../vista/procesandoCompra.php');
                    exit();
                }
            } elseif (isset($_POST['correo_invitado_reserva'])) {
                $correoInvitado = $_POST['correo_invitado_reserva'];
                $totalCompra = count($_SESSION['asientosElegidos']) * 8.15;
                $fecha_reserva = date('Y-m-d H:i:s'); 

                $reserva = new Reserva(null, $_SESSION['sesionElegida']['id_sesion'], $totalCompra, $fecha_reserva);
                $reserva->crearReserva();
                $id_reserva = $reserva->getId();

                foreach($_SESSION['asientosElegidos'] as $asiento){
                    $reservaAsiento = new ReservaAsiento($id_reserva, $asiento['id_asiento']);
                    $reservaAsiento->crearReservaAsiento();
                }

                $datosReserva = [
                    'titulo' => $_SESSION['peliculaElegida']['titulo'],
                    'sala' => $_SESSION['sesionElegida']['id_sala'],
                    'fecha' => date('d-m-Y H:i', strtotime($_SESSION['sesionElegida']['fecha_hora'])),
                    'precioTotal' => count($_SESSION['asientosElegidos']) * 8.15,
                    'imagenCartel' => '../imagenes/carteles/' . $_SESSION['peliculaElegida']['titulo'] . '.jpg',
                    'asientosElegidos' => $_SESSION['asientosElegidos']
                ];

                $ruta_pdf = '../servicios/entrada_cine.pdf';

                generarEntradaPDFMailer($datosReserva, $ruta_pdf);
                enviarEntradaCorreoInvitado($ruta_pdf, $correoInvitado);
                unlink($ruta_pdf);

                header('Location: ../vista/procesandoCompra.php');
                exit();
            }
        } else {
            $totalCompra = count($_SESSION['asientosElegidos']) * 8.15;
            $fecha_reserva = date('Y-m-d H:i:s'); 

            $reserva = new Reserva($_SESSION['user']['id_usuario'], $_SESSION['sesionElegida']['id_sesion'], $totalCompra, $fecha_reserva);
            $reserva->crearReserva();
            $id_reserva = $reserva->getId();
                    
            foreach($_SESSION['asientosElegidos'] as $asiento){
                $reservaAsiento = new ReservaAsiento($id_reserva, $asiento['id_asiento']);
                $reservaAsiento->crearReservaAsiento();
            }

            header('Location: ../vista/procesandoCompra.php');
            exit();
        }
    }
?>