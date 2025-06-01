<?php
    session_start();
    require_once('../modelo/asiento.php');
    require_once('../modelo/sesion.php');
    require_once('../modelo/pelicula.php');
    require_once('../modelo/reserva_asiento.php');

    $sesion = Sesion::getDatosSesion($_POST['id_sesion']);
    $pelicula = Pelicula::getPeliculaById($sesion['id_pelicula']);
    $asientos = Asiento::desplegarAsientos($sesion['id_sala']);
    $fechaFormateada = date('d-m-Y H:i', strtotime($sesion['fecha_hora']));
    $asientosOcupados = ReservaAsiento::obtenerAsientosOcupados($sesion['id_sesion']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=chair" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/cine/css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../include/navbar.php'; ?>    
    
    <div class="container bg-secondary bg-gradient rounded p-4 mt-4 text-warning" style="--bs-bg-opacity: .7;">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img class="img-fluid border-radius-lg shadow rounded"
                    src="../imagenes/carteles/<?php echo $pelicula['titulo'] ?>.jpg" alt="<?php echo $pelicula['titulo'] ?>" style="height: 300px; width: 300px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <h2 class="display-5 fw-bold"><?php echo $pelicula['titulo'] ?></h2>
                <p class="display-6">Sala <?php echo $sesion['id_sala'] ?> | <?php echo $fechaFormateada ?></p>
            </div>
        </div>
    </div>

    <div class="container bg-secondary bg-gradient rounded p-4 mt-4 mb-3" style="--bs-bg-opacity: .7;">
        <form id="formReservarAsientos" method="POST" action="/cine/vista/pagarReserva.php">
            <h2 class="text-warning text-center mb-4">Selecciona tus asientos</h2>
            <div class="mx-auto bg-light mt-5" style="height: 12px; width: 60%; border-radius: 20px 20px 0 0; box-shadow: 0 0 10px #fff; margin-bottom: 30px;"></div>
            <div class="d-flex justify-content-center flex-column align-items-center">

            <?php
                $asientosPorFila = [];

                // Agrupa los asientos según la fila a la que pertenecen
                foreach ($asientos as $asiento) {
                    $asientosPorFila[$asiento['fila']][] = $asiento;
                }

                // Recorremos cada fila con sus asientos agrupados
                foreach ($asientosPorFila as $fila => $asientosFila) {
                    echo "<div class='d-flex align-items-center mb-2'>";
                    echo "<div class='me-2 text-warning fw-bold' style='width: 60px;'>Fila $fila</div>";

                    // Recorremos todos los asientos de la fila actual
                    foreach ($asientosFila as $asiento) {
                        $id = $asiento['id_asiento'];
                        $ocupado = false;

                        // Comprobamos si este asiento está en la lista de asientos ocupados y si lo está se pone en disabled
                        foreach ($asientosOcupados as $ocupadoId) {
                            if ($id == $ocupadoId['id_asiento']) {
                                $ocupado = true;
                                break;
                            }
                        }

                        $disabled = '';
                        $clase = 'btn-outline-light';

                        if ($ocupado) {
                            $disabled = 'disabled';
                            $clase = 'btn-danger';
                        }

                        echo "
                            <div class='form-check me-1'>
                                <input class='btn-check' type='checkbox' name='asientosReservados[]' id='asiento$id' value='$id' $disabled>
                                <label class='btn $clase rounded-pill' for='asiento$id' style='width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;'>
                                    <span class='material-symbols-outlined'>chair</span>
                                </label>
                            </div>
                        ";
                    }
                    echo "</div>";
                }
            ?>

                <input type="hidden" name="id_sesion" value="<?php echo $_POST['id_sesion']; ?>">
                <button type="submit" class="btn btn-warning mt-3">Comprar entradas</button>
            </div>
        </form>
    </div>

    <?php include '../include/footer.php'; ?>

    <script>
        // Controla que el usuario no pueda seleccionar más de 5 asientos (checkboxes) en la página. 
        // Si intenta seleccionar más, desmarca la última opción y muestra una alerta.
        let maxAsientos = 5;
        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let selectedCount = 0;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                selectedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;

                if (selectedCount > maxAsientos) {
                    this.checked = false;
                    alert('Solo puedes seleccionar un máximo de 5 asientos para esta sesión.');
                }
            });
        });
    </script>

    <script>
        // Controla que el usuario tenga seleccionado al menos un asiento cuando le da al botón submit del formulario.
        document.getElementById("formReservarAsientos").addEventListener("submit", function(event) {
            var asientosSeleccionados = document.querySelectorAll('input[name="asientosReservados[]"]:checked');

            if (asientosSeleccionados.length === 0) {
                event.preventDefault();
                alert("Por favor, selecciona al menos un asiento para continuar.");
            }
        });
    </script>


    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>