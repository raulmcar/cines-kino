<?php
    session_start();

    $titulo = $_SESSION['peliculaElegida']['titulo'];
    $fecha = $_SESSION['sesionElegida']['fecha_hora'];
    $asientos = $_SESSION['asientosElegidos'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/cine/css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .check-icon {
            font-size: 4rem;
            color: green;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-secondary bg-gradient rounded p-4 text-warning text-center" style="--bs-bg-opacity: .9; width: 30rem;">
            <div id="estadoCompra">
                <div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">
                    <span class="visually-hidden">Procesando...</span>
                </div>
                <p class="mt-3 mb-0">Procesando compra...</p>
            </div>

            <div id="resumenCompra" style="display: none;">
                <div class="check-icon">✔️</div>
                <h2 class="mt-3">¡Compra completada!</h2>
                <div class="card shadow bg-success-subtle m-3 text-center" style="width: 25rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary fw-bold"><?php echo $titulo ?></h5>
                        <p class="card-text mb-1">Fecha y hora: <?php echo $fecha ?></p>
                        <p class="card-text mt-3">Asientos:</p>
                        <ul class="list-unstyled">
                        <?php
                            foreach ($asientos as $asiento) {
                                echo "<li><i class='bi bi-ticket-perforated'></i> Fila " . $asiento['fila'] . " - Asiento " . $asiento['numero'] . "</li>";
                            }
                        ?>
                        </ul>
                        <a href="../index.php" class="btn btn-primary mt-3">Volver al inicio</a>
                        <a href="../controlador/generarPdf.php" class="btn btn-warning mt-3">Descargar entrada PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('estadoCompra').style.display = 'none';
            document.getElementById('resumenCompra').style.display = 'block';
        }, 5000);
    </script>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
