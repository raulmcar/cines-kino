<?php
    require_once('../modelo/reserva.php'); 
    require_once('../modelo/sesion.php');
    require_once('../modelo/pelicula.php');
    require_once('../modelo/reserva_asiento.php');
    require_once('../include/modeloPdf.php');

    use Mpdf\Mpdf;

    if (!isset($_GET['id_reserva'])) {
        die("Reserva no especificada.");
    }

    $id_reserva = $_GET['id_reserva'];
    $reserva = Reserva::getReservaById($id_reserva);

    if (!$reserva) {
        die("Reserva no encontrada.");
    }

    $sesion = Sesion::getDatosSesion($reserva['id_sesion']);
    $pelicula = Pelicula::getPeliculaById($sesion['id_pelicula']);
    $asientos = ReservaAsiento::getAsientosByReserva($id_reserva);

    $datosReserva = [
        'titulo' => $pelicula['titulo'],
        'sala' => $sesion['id_sala'],
        'fecha' => date('d-m-Y H:i', strtotime($sesion['fecha_hora'])),
        'precioTotal' => $reserva['precio'],
        'imagenCartel' => '../imagenes/carteles/' . $pelicula['titulo'] . '.jpg',
        'asientosElegidos' => $asientos
    ];

    generarEntradaPDF($datosReserva);
?>
