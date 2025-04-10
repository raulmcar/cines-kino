<?php
    session_start();

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
<body>
    <nav class="navbar bg-black bg-gradient">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="../index.php">
                <img src="../imagenes/logo.png" alt="Bootstrap" width="110" height="80">
            </a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Cartelera</a>
            <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Foro</a>
        <div class="dropdown">
            <button class="btn btn-primary text-white rounded-circle dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill fs-3"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg" style="width: 250px;">
                <?php
                    if (isset($_SESSION['user'])){
                        if($_SESSION['user']['tipo_usuario'] == 'admin'){
                            echo "<a href='../controlador/cerrarSesion.php' class='btn btn-dark w-100'>Cerrar sesión</a>";
                            echo "<a href='../vista/iniciadoAdmin.php' class='btn btn-dark w-100'>Zona administrador</a>";
                        } else {
                            echo "<a href='../controlador/cerrarSesion.php' class='btn btn-dark w-100'>Cerrar sesión</a>";
                        }
                    } else {
                        echo "<h6 class='text-center fw-bold'>Iniciar Sesión</h6>
                                <form action='./controlador/autenticacion.php' method='post'>
                                    <div class='mb-2'>
                                        <label for='email' class='form-label'>Correo electrónico</label>
                                        <input type='email' class='form-control' name='email'>
                                    </div>
                                    <div class='mb-2'>
                                        <label for='password' class='form-label'>Contraseña</label>
                                        <input type='password' class='form-control' name='contrasena'>
                                    </div>
                                    <button type='submit' class='btn btn-dark w-100'>Entrar</button>
                                </form>
                                <p class='text-center mb-0 mt-1'>
                                    <a href='./vista/registrarUsuario.php' class='text-decoration-none'>¿No tienes cuenta? Regístrate</a>
                                </p>";
                    }
                ?>
            </div>
        </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-dark text-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="busquedaEmail" class="form-control form-control-sm" placeholder="Buscar por email...">
                </div>
            </div>
        </div>
    </div>

    <div class='container-fluid mt-4 d-flex justify-content-center w-100 mx-auto'>
        <table class='table table-striped table-hover'>
            <thead class='table-dark'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        <?php
        require_once('../modelo/usuario.php');
        Usuario::getAllUsers();

        if (isset($_SESSION['AllUsers'])){
            foreach ($_SESSION['AllUsers'] as $user) {
                $id = $user['id_usuario'];
                $nombre = $user['nombre'];

                echo "
                <tr>
                    <td>{$id}</td>
                    <td>{$user['nombre']}</td>
                    <td>{$user['apellidos']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['tipo_usuario']}</td>
                    <td>
                        <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modalEditar{$id}'>Editar</button>
                        <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#modalEliminar{$id}' data-id='{$id}' data-nombre='{$nombre}'>Eliminar</button>
                    </td>
                </tr>

                <div class='modal fade' id='modalEditar{$id}' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <form method='POST' action='../controlador/editarUsuario.php'>
                                <div class='modal-header'>
                                    <h5 class='modal-title'>Editar Usuario</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>
                                <div class='modal-body'>
                                    <input type='hidden' name='id_usuario_hidden' value={$id}>
                                    <div class='mb-3'>
                                        <label class='form-label'>Nombre</label>
                                        <input type='text' class='form-control' name='newnombre' value='{$user['nombre']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label'>Apellidos</label>
                                        <input type='text' class='form-control' name='newapellidos' value='{$user['apellidos']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label'>Email</label>
                                        <input type='email' class='form-control' name='newemail' value='{$user['email']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label'>Permisos (user/admin)</label>
                                        <input type='text' class='form-control' name='newtipo_usuario' value='{$user['tipo_usuario']}' required>
                                    </div>
                                </div>
                                <div class='modal-footer'>
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
                            <form method='POST' action='../controlador/eliminarUsuario.php'>
                                <div class='modal-header'>
                                    <h5 class='modal-title'>¿Eliminar usuario?</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>
                                <div class='modal-body'>
                                    <input type='hidden' name='id_usuario_hidden' value={$id}>
                                    <p id='mensajeEliminar{$id}'>¿Estás seguro de que deseas eliminar este usuario?</p>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                    <button type='submit' class='btn btn-danger'>Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No hay usuarios registrados</p>";
        }   
        ?>

    <script>
        document.getElementById('busquedaEmail').addEventListener('keyup', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('table tbody tr');

            filas.forEach(fila => {
                const email = fila.cells[3].textContent.toLowerCase();
                if (email.includes(filtro)) {
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