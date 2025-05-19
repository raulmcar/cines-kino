<?php
    require_once(__DIR__ . '/../vendor/autoload.php');

    function generarEntradaPDF($datos){
            $html = '
                <html>
                <head>
                    <style>
                        body {
                            font-family: "Arial", sans-serif;
                            background-color: #f8f9fa;
                            color: #333;
                        }
                        .entrada {
                            border: 2px dashed #888;
                            padding: 20px;
                            margin: 20px auto;
                            width: 600px;
                            background-color: #fff;
                        }
                        .titulo {
                            text-align: center;
                            font-size: 24px;
                            font-weight: bold;
                            margin-bottom: 10px;
                        }
                        .info {
                            margin-top: 10px;
                            font-size: 16px;
                        }
                        .asientos {
                            margin-top: 10px;
                            font-size: 16px;
                            list-style-type: none;
                            padding-left: 0;
                        }
                        .precio {
                            font-size: 18px;
                            font-weight: bold;
                            margin-top: 15px;
                            text-align: right;
                        }
                        .cartel {
                            text-align: center;
                            margin-bottom: 15px;
                        }
                        .cartel img {
                            max-width: 200px;
                            border-radius: 10px;
                        }
                    </style>
                </head>
                <body>
                    <div class="entrada">
                        <div class="cartel">
                            <img src="' . $datos['imagenCartel'] . '" alt="Cartel">
                        </div>
                        <div class="titulo">Entrada de Cine</div>
                        <div class="info"><strong>Pelicula:</strong> ' . htmlspecialchars($datos['titulo']) . '</div>
                        <div class="info"><strong>Sala:</strong> ' . htmlspecialchars($datos['sala']) . '</div>
                        <div class="info"><strong>Fecha y hora:</strong> ' . htmlspecialchars($datos['fecha']) . '</div>
                        <div class="info"><strong>Asientos:</strong></div>
                        <ul class="asientos">';
                
                        foreach ($datos['asientosElegidos'] as $asiento) {
                            $html .= '<li>Fila ' . htmlspecialchars($asiento['fila']) . ' - Asiento ' . htmlspecialchars($asiento['numero']) . '</li>';
                        }

                $html .= '
                        </ul>
                        <div class="precio">Total: ' . number_format($datos['precioTotal'], 2) . ' €</div>
                    </div>
                </body>
                </html>';

                $mpdf = new \mPDF();
                $mpdf->WriteHTML($html);
                $mpdf->Output("entrada_cine.pdf", "D");
    }
?>