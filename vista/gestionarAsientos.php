<?php
    session_start();
    require_once('../modelo/sala.php');
    require_once('../modelo/asiento.php');

    if (!isset($_SESSION['user'])){
        $_SESSION['msg'] = "Necesitas iniciar sesión para entrar aquí.";
        header('Location: ../index.php');
        exit();
    } else {
        if ($_SESSION['user']['tipo_usuario'] !== 'admin'){
            $_SESSION['msg'] = "NO ESTAS AUTORIZADO PARA ENTRAR AQUI. SE PROCEDERÁ A LLAMAR A LAS AUTORIDADES COMPETENTES PARA SU SANCIÓN.";
            header('Location: ../index.php');
            exit();
        }
    }
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
    <link rel="stylesheet" href="../css/index.css?v=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../include/navbar.php'; ?>

    <div class="container w-100 d-flex justify-content-center rounded mb-5">
        <form id="formulario" class="col-6 mt-5 p-3 rounded bg-dark-subtle bg-gradient text-dark" action="../controlador/registrarAsiento.php" method="post">
            <div class="mb-2">
            <?php
                $salas = Sala::desplegarSalas();

                if(!empty($salas)){
                    echo "<select class='form-select mb-3' name='sala'>";
                    foreach($salas as $sala){
                        echo "<option value='{$sala['id_sala']}'>{$sala['nombre']}</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<p>No hay salas registradas</p>";
                }
            ?>
            </div>
            <div class="mb-2">
                <label class="form-label">Fila</label>
                <input type="number"  name="fila" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Número</label>
                <input type="number"  name="numero" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary text-center mt-2">Regsitrar asiento</button>
        </form>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="busquedaSala" class="form-control form-control-sm" placeholder="Buscar por sala...">
                </div>
            </div>
        </div>
    </div>

    <?php $asientos = Asiento::desplegarAllAsientos(); ?>

    <div class="container mt-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fila</th>
                    <th>Número</th>
                    <th>Sala</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($asientos)) {
                    foreach ($asientos as $asiento) {
                        $id = $asiento['id_asiento'];
                        $fila = $asiento['fila'];
                        $numero = $asiento['numero'];
                        $sala = $asiento['id_sala'];

                        echo "
                            <tr>
                                <td>{$id}</td>
                                <td>{$fila}</td>
                                <td>{$numero}</td>
                                <td>{$sala}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#modalEliminar{$id}'>
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <div class='modal fade' id='modalEliminar{$id}' tabindex='-1' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <form method='POST' action='../controlador/eliminarAsiento.php'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>Eliminar Asiento</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <input type='hidden' name='id_asiento' value='{$id}'>
                                                <p>¿Estás seguro de eliminar el asiento <strong>Fila {$fila}, Número {$numero}</strong> de la sala <strong>{$sala}</strong>?</p>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                                <button type='submit' class='btn btn-danger'>Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay asientos registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include '../include/footer.php'; ?>

    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>

    <script>
        document.getElementById('busquedaSala').addEventListener('input', function () {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('table tbody tr');

            filas.forEach(fila => {
                const nombreSala = fila.cells[3].textContent.toLowerCase();
                fila.style.display = nombreSala.includes(filtro) ? '' : 'none';
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>