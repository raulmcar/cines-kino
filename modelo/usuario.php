<?php
    /**
     * @file Usuario.php
     * @brief Contiene la clase Usuario para la gestión de usuarios en la base de datos.
     */

    require_once('bd.php');

    /**
     * @class Usuario
     * @brief Representa a un usuario del sistema y proporciona métodos para su gestión.
     */
    class Usuario{
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $contrasena;
        private string $telefono;
        private string $dni;
        private string $fecha_nacimiento;
        private string $tipo_usuario;

        /**
         * @brief Constructor de la clase Usuario.
         * @param string $nombre Nombre del usuario.
         * @param string $apellidos Apellidos del usuario.
         * @param string $email Correo electrónico del usuario.
         * @param string $contrasena Contraseña en texto plano (se encripta internamente).
         * @param string $telefono Teléfono del usuario.
         * @param string $dni DNI del usuario.
         * @param string $fecha_nacimiento Fecha de nacimiento.
         * @param string $tipo_usuario Tipo de usuario (cliente, admin...).
         */
        public function __construct(string $nombre, string $apellidos, string $email, string $contrasena, string $telefono, 
        string $dni, string $fecha_nacimiento, string $tipo_usuario){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
            $this->telefono = $telefono;
            $this->dni = $dni;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->tipo_usuario = $tipo_usuario;
        }

        /**
         * @brief Destructor de la clase Usuario. Limpia los atributos.
         */
        public function __destruct(){
            $this->nombre = "";
            $this->apellidos = "";
            $this->email = "";
            $this->contrasena = "";
            $this->telefono = "";
            $this->dni = "";
            $this->fecha_nacimiento = "";
            $this->tipo_usuario = "";
        }

        /**
         * @brief Registra al usuario en la base de datos.
         * @return bool Devuelve true si el registro fue exitoso, false si falló.
         */
        public function registrarUsuario(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO usuario(nombre, apellidos, email, 
                contrasena, telefono, dni, fecha_nacimiento, tipo_usuario)
                    VALUES (?,?,?,?,?,?,?,?)");

                $consulta->bindParam(1, $this->nombre);
                $consulta->bindParam(2, $this->apellidos);
                $consulta->bindParam(3, $this->email);
                $consulta->bindParam(4, $this->contrasena);
                $consulta->bindParam(5, $this->telefono);
                $consulta->bindParam(6, $this->dni);
                $consulta->bindParam(7, $this->fecha_nacimiento);
                $consulta->bindParam(8, $this->tipo_usuario);

                $consulta->execute();
                $registro = true;
                return $registro;
                unset($bdConexion);
            }
            catch(PDOException $e){
                echo "Error al insertar los datos: " . $e->getMessage();
                return $registro;
            }
        }

        /**
         * @brief Comprueba si un correo electrónico ya está registrado.
         * @param string $email Correo a comprobar.
         * @return bool Devuelve true si el correo existe, false si no.
         */
        public function comprobarCorreo(string $email){
            $existe = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT email FROM usuario WHERE email = '$email'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $fila = $consulta->fetch();

                if ($fila){
                    $existe = true;
                } else {
                    $existe = false;
                }

            }
            catch(PDOException $e){
                echo "Error al consultar los datos: " . $e->getMessage();
            }

            return $existe;
        }

        /**
         * @brief Inicia sesión con un email y contraseña.
         * @param string $email Correo electrónico del usuario.
         * @param string $password Contraseña en texto plano.
         * @return array|false Devuelve los datos del usuario si inicia sesión correctamente, false en caso contrario.
         */
        public static function iniciarSesion(string $email, string $password){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM usuario WHERE email = '$email'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $usuario = $consulta->fetch();

                if ($usuario && password_verify($password, $usuario['contrasena'])){
                    $_SESSION['user'] = $usuario;
                    return $_SESSION['user'];
                } 

            }
            catch(PDOException $e){
                echo "Error al encontrar los datos: " . $e->getMessage();
            }

            return false;
        }

        /**
         * @brief Obtiene todos los usuarios del sistema.
         * @return array Lista de todos los usuarios.
         */
        public static function getAllUsers(){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM usuario");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $users = [];

                while ($user = $consulta->fetch()) {
                    $users[] = $user;
                }

                $_SESSION['AllUsers'] = $users;

                return $_SESSION['AllUsers'];
            }
            catch(PDOException $e){
                echo "Error al mostrar los usuarios " . $e->getMessage();
                return $users = [];
            }
        }

        /**
         * @brief Elimina un usuario por su ID.
         * @param int $id_usuario ID del usuario a eliminar.
         * @return bool Devuelve true si fue eliminado, false en caso de error.
         */
        public static function eliminarUsuario(int $id_usuario){
            $borrado = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM usuario WHERE id_usuario = '$id_usuario'");
                $consulta->execute();
                $borrado = true;

                return $borrado;
                unset($bdConexion);
            }
            catch(PDOException $e){
                echo "Ha habido un error al eliminar el usuario: " . $e->getMessage();
                
                return $borrado;
            }
        }

        /**
         * @brief Actualiza los datos de un usuario.
         * @param int $id_usuario ID del usuario.
         * @param string $newnombre Nuevo nombre.
         * @param string $newapellidos Nuevos apellidos.
         * @param string $newemail Nuevo correo electrónico.
         * @param string $newtipousuario Nuevo tipo de usuario.
         * @return bool Devuelve true si fue actualizado correctamente, false si falló.
         */
        public static function actualizarUsuario(int $id_usuario, string $newnombre, string $newapellidos, string $newemail, string $newtipousuario){
            $actualizado = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("UPDATE usuario SET nombre = '$newnombre', apellidos = '$newapellidos',
                    email = '$newemail', tipo_usuario = '$newtipousuario' WHERE id_usuario = '$id_usuario'");
                $consulta->execute();
                $actualizado = true;

                return $actualizado;
                unset($bdConexion);
            }
            catch(PDOException $e){
                echo "Ha habido un error al actualizar los datos: " . $e->getMessage;

                return $actualizado;
            }
        }
    }
?>