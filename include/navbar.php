<nav class="navbar navbar-expand-lg bg-black bg-gradient">
    <div class="container">

        <a class="navbar-brand" href="/cine/index.php">
            <img src="/cine/imagenes/logo.png" alt="Bootstrap" width="110" height="80">
        </a>
        
        <button class="navbar-toggler order-lg-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse order-lg-0" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item px-5">
                    <a class="nav-link fs-4 fw-semibold text-warning" href="/cine/vista/cartelera.php">Cartelera</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link fs-4 fw-semibold text-warning" href="/cine/vista/promociones.php">Promociones</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link fs-4 fw-semibold text-warning" href="/cine/vista/contactanos.php">Contáctanos</a>
                </li>
            </ul>
        </div>

        <div class="dropdown order-lg-2">
            <button class="btn btn-primary text-white rounded-circle dropdown-toggle" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill fs-3"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end p-3 m-0 shadow-lg" style="width: 250px;">
                <?php
                    if (isset($_SESSION['user'])){
                        if($_SESSION['user']['tipo_usuario'] == 'admin'){
                            echo "<a href='/cine/vista/iniciadoAdmin.php' class='btn btn-dark w-100 m-1'>Zona administrador</a>";
                        }
                        echo "<a href='/cine/vista/miPerfil.php' class='btn btn-dark w-100 m-1'>Mi perfil</a>";
                        echo "<a href='/cine/controlador/cerrarSesion.php' class='btn btn-dark w-100 m-1'>Cerrar sesión</a>";
                    } else {
                        echo "<h6 class='text-center fw-bold'>Iniciar Sesión</h6>
                                <form action='/cine/controlador/autenticacion.php' method='post'>
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
                                    <a href='/cine/vista/registrarUsuario.php' class='text-decoration-none'>¿No tienes cuenta? Regístrate</a>
                                </p>";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>