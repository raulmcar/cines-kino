<?php
    session_start();
    require_once('../modelo/pelicula.php');

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
        <form id="formulario" class="col-6 mt-5 p-3 rounded bg-dark-subtle bg-gradient text-dark" enctype="multipart/form-data" action="../controlador/registrarPelicula.php" method="post">
            <div class="mb-2">
                <label class="form-label">Nombre de la película</label>
                <input type="text" name="nombrePeli" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Sinopsis</label>
                <input type="text" name="sinopsis" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Duración</label>
                <input type="number"  name="duracion" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Género</label>
                <input type="text" name="genero" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Clasificación</label>
                <input type="number" name="clasificacion" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Cartel de la película</label>
                <input type="file" name="cartelPeli" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Director</label>
                <input type="text" name="director" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Año de estreno</label>
                <input type="number" name="anio" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label" for="estreno">¿Estreno?</label>
                <select name="estreno" id="estreno" class="form-select">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary text-center mt-2">Regsitrar pelicula</button>
        </form>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="busquedaPeli" class="form-control form-control-sm" placeholder="Buscar por nombre de película...">
                </div>
            </div>
        </div>
    </div>

    <?php
        $peliculas = Pelicula::desplegarPeliculas(); 
    ?>

    <div class="container mt-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Género</th>
                    <th>Director</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (isset($peliculas)) {
                foreach ($peliculas as $peli) {
                    $id = $peli['id_pelicula'];
                    $nombre = $peli['titulo'];

                    echo "
                    <tr>
                        <td>{$id}</td>
                        <td>{$nombre}</td>
                        <td>{$peli['duracion']} min</td>
                        <td>{$peli['genero']}</td>
                        <td>{$peli['director']}</td>
                        <td>
                            <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modalEditar{$id}'>Editar</button>
                            <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#modalEliminar{$id}'>Eliminar</button>
                        </td>
                    </tr>

                    <div class='modal fade' id='modalEditar{$id}' tabindex='-1' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <form method='POST' action='../controlador/actualizarPelicula.php'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Editar Película</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <input type='hidden' name='id_pelicula_hidden' value='{$id}'>
                                        <div class='mb-3'>
                                            <label class='form-label'>Nombre</label>
                                            <input type='text' class='form-control' name='newnombre' value='{$nombre}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Duración</label>
                                            <input type='number' class='form-control' name='newduracion' value='{$peli['duracion']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Género</label>
                                            <input type='text' class='form-control' name='newgenero' value='{$peli['genero']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Director</label>
                                            <input type='text' class='form-control' name='newdirector' value='{$peli['director']}' required>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='hidden' name='nombre_pelicula_hidden' value='{$nombre}'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                        <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='modalEliminar{$id}' tabindex='-1' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <form method='POST' action='../controlador/eliminarPelicula.php'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>¿Eliminar película?</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <input type='hidden' name='id_pelicula_hidden' value='{$id}'>
                                        <input type='hidden' name='nombre_pelicula_hidden' value='{$nombre}'>
                                        <p>¿Estás seguro de que deseas eliminar <strong>{$nombre}</strong>?</p>
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
                echo "<tr><td colspan='6'>No hay películas registradas</td></tr>";
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
        document.getElementById('busquedaPeli').addEventListener('keyup', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('table tbody tr');

            filas.forEach(fila => {
                const nombre = fila.cells[1].textContent.toLowerCase().trim();
                if (nombre.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>