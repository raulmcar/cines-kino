<nav class="navbar bg-black bg-gradient">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="../index.php">
            <img src="./imagenes/logo.png" alt="Bootstrap" width="110" height="80">
        </a>
        <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Cartelera</a>
        <a class="navbar-brand fs-4 fw-semibold mx-auto text-light" href="#">Foro</a>
    <div class="dropdown">
        <button class="btn btn-primary text-white rounded-circle dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-fill fs-3"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end p-3 m-0 shadow-lg" style="width: 250px;">
            <?php
                if (isset($_SESSION['user'])){
                    if($_SESSION['user']['tipo_usuario'] == 'admin'){
                        echo "<a href='vista/iniciadoAdmin.php' class='btn btn-dark w-100 m-1'>Zona administrador</a>";
                    }
                    echo "<a href='vista/miPerfil.php' class='btn btn-dark w-100 m-1'>Mi perfil</a>";
                    echo "<a href='controlador/cerrarSesion.php' class='btn btn-dark w-100 m-1'>Cerrar sesión</a>";
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