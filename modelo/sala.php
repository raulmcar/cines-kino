<?php
    /**
     * @file Sala.php
     * @brief Contiene la clase Sala para la gestión de salas en la base de datos.
     */

    require_once('bd.php');

    /**
     * @class Sala
     * @brief Clase que representa una sala del cine.
     */
    class Sala{
        private string $nombre;
        private int $capacidad;

        /**
         * @brief Constructor de la clase Sala
         * @param string $nombre Nombre de la sala
         */
        public function __construct(string $nombre){
            $this->nombre = $nombre;
        }

        /**
         * @brief Destructor de la clase Sala
         */
        public function __destruct(){
            $this->nombre = "";
        }

        /**
         * @brief Registra una nueva sala en la base de datos
         * @return bool True si se registró correctamente, False en caso de error
         */
        public function registrarSala(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO sala(nombre)
                    VALUES (?)");

                $consulta->bindParam(1, $this->nombre);

                $consulta->execute();
                $registro = true;
                return $registro;
                unset($bdConexion);
            }
            catch(PDOException $e) {
                echo "Error al insertar los datos: " . $e->getMessage();
                return $registro;
            } 
        }
        
        /**
         * @brief Comprueba si una sala ya existe en la base de datos
         * @param string $sala Nombre de la sala a comprobar
         * @return bool True si existe, False si no existe
         */
        public function comprobarSala(string $sala){
            $existe = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT nombre FROM sala WHERE nombre = '$sala'");
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
         * @brief Devuelve todas las salas registradas
         * @return array Array con todas las salas
         */
        public static function desplegarSalas(){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sala");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $salas = [];

                while ($sala = $consulta->fetch()){
                    $salas[] = $sala;
                }

                return $salas;
            }
            catch(PDOException $e){
                echo "Error al mostrar las salas " . $e->getMessage();
                return $salas = [];
            }
        }

        /**
         * @brief Actualiza el nombre de una sala en la base de datos
         * @param int $idSala ID de la sala a actualizar
         * @param string $nuevoNombre Nuevo nombre para la sala
         * @return bool True si se actualizó correctamente, False si ocurrió un error
         */
        public static function actualizarSala($idSala, $nuevoNombre) {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("UPDATE sala SET nombre = (?) WHERE id_sala = (?)");
                $consulta->bindParam(1, $nuevoNombre);
                $consulta->bindParam(2, $idSala);

                return $consulta->execute(); 
            } 
            catch (PDOException $e) {
                error_log("Error en actualizarSala: " . $e->getMessage());
                return false;
            }
        }

        /**
         * @brief Elimina una sala de la base de datos
         * @param int $idSala ID de la sala a eliminar
         * @return bool True si se eliminó correctamente, False si ocurrió un error
         */
        public static function eliminarSala($idSala) {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM sala WHERE id_sala = (?)");
                $consulta->bindParam(1, $idSala);

                return $consulta->execute();
            } 
            catch (PDOException $e) {
                error_log("Error en eliminarSala: " . $e->getMessage());
                return false;
            }
        }
    }
?>