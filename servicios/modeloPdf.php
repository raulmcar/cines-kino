<?php
    require_once(__DIR__ . '/../vendor/autoload.php');

    use Mpdf\Mpdf;

    function generarEntradaPDF($datos){
        $html = '
            <html>
            <head>
                <style>
                    body {
                        font-family: "Arial", sans-serif;
                        background-color: #f8f9fa;
                        color: #333;
                        margin: 0;
                        padding: 0;
                    }
                    .entrada {
                        border: 2px dashed #888;
                        padding: 10px;
                        margin: 5px auto;
                        width: 500px;
                        background-color: #fff;
                    }
                    .titulo {
                        text-align: center;
                        font-size: 18px;
                        font-weight: bold;
                        margin: 5px 0;
                    }
                    .info {
                        font-size: 13px;
                        margin: 3px 0;
                    }
                    .asientos {
                        font-size: 13px;
                        list-style-type: none;
                        padding-left: 0;
                        margin: 3px 0;
                    }
                    .precio {
                        font-size: 14px;
                        font-weight: bold;
                        margin-top: 8px;
                        text-align: right;
                    }
                    .qr {
                        text-align: center;
                        margin-top: 5px;
                    }
                </style>
            </head>
            <body>
                <div class="entrada">
                    <div class="cartel" style="text-align: center; margin-bottom: 10px;">
                        <img src="' . $datos['imagenCartel'] . '" alt="Cartel" style="height: 600px; display: block; margin: 0 auto; border-radius: 6px;">
                    </div>
                    <div class="titulo">DATOS DE TU ENTRADA</div>
                    <div class="info"><strong>Pelicula:</strong> ' . $datos['titulo'] . '</div>
                    <div class="info"><strong>Sala:</strong> ' . $datos['sala'] . '</div>
                    <div class="info"><strong>Fecha y hora:</strong> ' . $datos['fecha'] . '</div>
                    <div class="info"><strong>Asientos:</strong></div>
                    <ul class="asientos">';

            foreach ($datos['asientosElegidos'] as $asiento) {
                $html .= '<li>Fila ' . $asiento['fila'] . ' - Asiento ' . $asiento['numero'] . '</li>';
            }

            $html .= '
                    </ul>
                    <div class="precio">Total: ' . number_format($datos['precioTotal'], 2) . ' €</div>
                    <div class="qr">
                        <barcode code="Entrada: ' . $datos['titulo'] . '" type="QR" size="1.4" error="M" />
                        <div style="font-size: 10px; color: #555;">Escanea para confirmar</div>
                    </div>
                </div>
            </body>
            </html>';

        $mpdf = new Mpdf(['format' => 'A4']);
        $mpdf->WriteHTML($html);
        $mpdf->Output("entrada_cine.pdf", "D");
    }
?>