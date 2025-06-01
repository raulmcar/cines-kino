<?php
    /**
     * @file asiento.php
     * @brief Contiene la clase Reserva para la gestión de asientos en la base de datos.
     */
    require_once('bd.php');

    /**
     * @class Asiento
     * @brief Clase que representa un asiento dentro de una sala y permite gestionarlos en la base de datos.
     */
    class Asiento{
        private int $idSala;
        private int $fila;
        private int $numero;

        /**
         * @brief Constructor de la clase Asiento.
         * @param idSala ID de la sala a la que pertenece el asiento.
         * @param fila Número de fila.
         * @param numero Número de asiento en la fila.
         */
        public function __construct(int $idSala, int $fila, int $numero){
            $this->idSala = $idSala;
            $this->fila = $fila;
            $this->numero = $numero;
        }

        /**
         * @brief Destructor de la clase Asiento.
         * Reinicia los atributos del asiento.
         */
        public function __destruct(){
            $this->idSala = 0;
            $this->fila = 0;
            $this->numero = 0;
        }

        /**
         * @brief Registra un nuevo asiento en la base de datos.
         * @return bool True si el asiento se registró correctamente, False en caso contrario.
         */
        public function registrarAsiento(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO asiento(id_sala, fila, numero)
                    VALUES (?,?,?)");

                $consulta->bindParam(1, $this->idSala);
                $consulta->bindParam(2, $this->fila);
                $consulta->bindParam(3, $this->numero);

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
         * @brief Devuelve todos los asientos de una sala específica.
         * @param id_sala ID de la sala.
         * @return array Lista de asientos de la sala.
         */
        public static function desplegarAsientos(int $id_sala){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM asiento WHERE id_sala = '$id_sala'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $asientos = [];

                while ($asiento = $consulta->fetch()){
                    $asientos[] = $asiento;
                }

                return $asientos;
            }
            catch(PDOException $e){
                echo "Error al mostrar los asientos " . $e->getMessage();
                return $asientos = [];
            }
        }

        /**
         * @brief Devuelve los asientos correspondientes a una lista de IDs.
         * @param asientos_id Array de identificadores de asientos.
         * @return array Lista de asientos encontrados.
         */
        public static function getAsientosByIds(array $asientos_id){

            try{
                $cadenaAsientosId = implode(',', $asientos_id);

                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM asiento WHERE id_asiento IN ($cadenaAsientosId)");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $asientosReserva = [];

                while ($asiento = $consulta->fetch()){
                    $asientosReserva[] = $asiento;
                }

                return $asientosReserva;
            }
            catch(PDOException $e){
                echo "Error al mostrar los asientos reservados " . $e->getMessage();
                return $asientosReserva = [];
            }
        }

        /**
         * @brief Devuelve todos los asientos existentes en el sistema.
         * @return array Lista completa de asientos.
         */
        public static function desplegarAllAsientos() {
            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM asiento ORDER BY id_asiento ASC");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $asientos = [];

                while ($asiento = $consulta->fetch()) {
                    $asientos[] = $asiento;
                }

                return $asientos;
            } 
            catch (PDOException $e) {
                echo "Error al mostrar los asientos: " . $e->getMessage();
                return [];
            }
        }

        /**
         * @brief Elimina un asiento de la base de datos.
         * @param id Identificador del asiento a eliminar.
         * @return bool True si se eliminó correctamente, False en caso de error.
         */
        public static function eliminarAsiento($id) {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM asiento WHERE id_asiento = (?)");
                $consulta->bindParam(1, $id);

                return $consulta->execute();
            } 
            catch (PDOException $e) {
                echo "Error al eliminar asiento: " . $e->getMessage();
                return false;
            }
        }
    }
?>