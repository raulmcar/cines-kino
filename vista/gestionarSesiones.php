<?php
    session_start();
    require_once('../modelo/sala.php');
    require_once('../modelo/pelicula.php');
    require_once('../modelo/sesion.php');

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
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../include/navbar.php'; ?>

    <div class="container w-100 d-flex justify-content-center rounded mb-5">
        <form id="formulario" class="col-6 mt-5 p-3 rounded bg-dark-subtle bg-gradient text-dark" action="../controlador/registrarSesion.php" method="post">
            <div class="mb-2">
            <?php
                $pelis = Pelicula::desplegarPeliculas();

                if(!empty($pelis)){
                    echo "<select class='form-select mb-3' name='peli'>";
                    foreach($pelis as $peli){
                        echo "<option value='{$peli['id_pelicula']}'>{$peli['titulo']}</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<p>No hay pelis registradas</p>";
                }
            ?>
            </div>
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
                <label class="form-label">Fecha de la sesión</label>
                <input type="datetime-local"  id="fechaSesion" name="fechaSesion" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary text-center mt-2">Regsitrar sesion</button>
        </form>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="busquedaSesion" class="form-control form-control-sm" placeholder="Buscar por nombre de pelicula...">
                </div>
            </div>
        </div>
    </div>

    <?php
        $sesiones = Sesion::desplegarSesiones(); 
    ?>

    <div class="container mt-4">
        <table id="tablaSesiones" class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Película</th>
                    <th>Sala</th>
                    <th>Fecha y hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($sesiones)) {
                foreach ($sesiones as $sesion) {
                    $idSesion = $sesion['id_sesion'];
                    $tituloPelicula = $sesion['pelicula']; 
                    $nombreSala = $sesion['sala'];
                    $fechaHora = $sesion['fecha_hora'];

                    echo "
                    <tr>
                        <td>{$idSesion}</td>
                        <td>{$tituloPelicula}</td>
                        <td>{$nombreSala}</td>
                        <td>{$fechaHora}</td>
                        <td>
                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#modalEliminar{$idSesion}'>Eliminar</button>
                        </td>
                    </tr>

                    <div class='modal fade' id='modalEliminar{$idSesion}' tabindex='-1' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <form method='POST' action='../controlador/eliminarSesion.php'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Eliminar Sesión</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <input type='hidden' name='id_sesion' value='{$idSesion}'>
                                        <p>¿Seguro que quieres eliminar la sesión de <strong>{$tituloPelicula}</strong> en la sala <strong>{$nombreSala}</strong>?</p>
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
                echo "<tr><td colspan='5'>No hay sesiones registradas.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php include '../include/footer.php'; ?>

    <script>
        document.getElementById('busquedaSesion').addEventListener('input', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('#tablaSesiones tbody tr');

            filas.forEach(fila => {
                const textoSala = fila.cells[1].textContent.toLowerCase();

                if (textoSala.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    </script>    

    <script>
        // Establece la fecha y hora mínima seleccionable en un input tipo datetime-local a la fecha y hora actual, y 
        // evita que el usuario seleccione una fecha pasada mostrando una alerta y limpiando el campo.
        const inputFecha = document.getElementById('fechaSesion');

        const ahora = new Date();
        const año = ahora.getFullYear();
        const mes = String(ahora.getMonth() + 1).padStart(2, '0');
        const dia = String(ahora.getDate()).padStart(2, '0');
        const horas = String(ahora.getHours()).padStart(2, '0');
        const minutos = String(ahora.getMinutes()).padStart(2, '0');
        const fechaMin = `${año}-${mes}-${dia}T${horas}:${minutos}`;

        inputFecha.min = fechaMin;

        inputFecha.addEventListener('change', () => {
            const seleccionada = new Date(inputFecha.value);
            const ahoraActualizado = new Date();

            if (seleccionada < ahoraActualizado) {
                alert("No puedes seleccionar una fecha pasada.");
                inputFecha.value = "";
            }
        });
    </script>
    
    <?php
        if (isset($_SESSION['msg'])) {
            echo "<script>alert('" . $_SESSION['msg'] . "');</script>";
            unset($_SESSION['msg']);
        } 
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>