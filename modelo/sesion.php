<?php
    /**
     * @file Sesion.php
     * @brief Contiene la clase Sesion para la gestión de sesiones en la base de datos.
     */

    require_once('bd.php');

    /**
     * @class Sesion
     * @brief Clase que gestiona las sesiones de películas.
     */
    class Sesion{
        private int $idPelicula;
        private int $idSala;
        private string $fechaSesion;

        /**
         * @brief Constructor de la clase Sesion
         * @param int $idPelicula ID de la película
         * @param int $idSala ID de la sala
         * @param string $fechaSesion Fecha y hora de la sesión
         */
        public function __construct(int $idPelicula, int $idSala, string $fechaSesion){
            $this->idPelicula = $idPelicula;
            $this->idSala = $idSala;
            $this->fechaSesion = $fechaSesion;
        }

        /**
         * @brief Destructor de la clase Sesion
         */
        public function __destruct(){
            $this->idPelicula = 0;
            $this->idSala = 0;
            $this->fechaSesion = "";
        }

        /**
         * @brief Registra una nueva sesión en la base de datos
         * @return bool True si se registró correctamente, false en caso contrario
         */
        public function registrarSesion(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO sesion(id_pelicula, id_sala, fecha_hora)
                    VALUES (?,?,?)");
                
                $consulta->bindParam(1, $this->idPelicula);
                $consulta->bindParam(2, $this->idSala);
                $consulta->bindParam(3, $this->fechaSesion);

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
         * @brief Obtiene las sesiones por ID de película y fecha
         * @param int $id_pelicula ID de la película
         * @param string $fecha Fecha (formato YYYY-MM-DD)
         * @return array Lista de sesiones
         */
        public static function getSesionesById(int $id_pelicula, string $fecha){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sesion WHERE id_pelicula = '$id_pelicula' AND DATE(fecha_hora) = '$fecha'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesiones = [];

                while ($sesion = $consulta->fetch()){
                    $sesiones[] = $sesion;
                }

                return $sesiones;
            }
            catch(PDOException $e){
                echo "Error al mostrar las sesiones " . $e->getMessage();
                return $sesiones = [];
            }
        }

        /**
         * @brief Obtiene los datos de una sesión por su ID
         * @param int $id_sesion ID de la sesión
         * @return mixed Datos de la sesión o null
         */
        public static function getDatosSesion(int $id_sesion){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sesion WHERE id_sesion = '$id_sesion'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesion = $consulta->fetch();

                return $sesion;
            }
            catch(PDOException $e){
                echo "Error al buscar la sesion " . $e->getMessage();
            }
        }

        /**
         * @brief Muestra todas las sesiones registradas con información de película y sala
         * @return array Lista de sesiones
         */
        public static function desplegarSesiones() {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT s.id_sesion, p.titulo AS pelicula, sa.nombre AS sala, s.fecha_hora 
                    FROM sesion s
                    JOIN pelicula p ON s.id_pelicula = p.id_pelicula
                    JOIN sala sa ON s.id_sala = sa.id_sala
                    ORDER BY s.fecha_hora ASC
                ");
                $consulta->fetchAll(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesiones = [];

                while ($sesion = $consulta->fetch()){
                    $sesiones[] = $sesion;
                }

                return $sesiones;
            } 
            catch (PDOException $e) {
                echo "Error al mostrar las sesiones " . $e->getMessage();
                return $sesiones = [];
            }
        }

        /**
         * @brief Elimina una sesión por su ID
         * @param int $idSesion ID de la sesión a eliminar
         * @return bool True si se eliminó correctamente, false en caso de error
         */
        public static function eliminarSesion(int $idSesion) {
            $borrado = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM sesion WHERE id_sesion = (?)");
                $consulta->bindParam(1, $idSesion);
                $consulta->execute();

                $borrado = true;
                return $borrado;
            } 
            catch (PDOException $e) {
                echo "Error al eliminar sesión: " . $e->getMessage();
                return $borrado;
            }
        }
    }

?>