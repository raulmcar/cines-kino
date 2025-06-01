<?php
    /**
     * @file Reserva_asiento.php
     * @brief Contiene la clase Reserva para la gestión de reservas de los asientos en la base de datos.
     */
    require_once('bd.php');

    /**
     * @class ReservaAsiento
     * @brief Clase que representa la relación entre una reserva y los asientos reservados.
     */
    class ReservaAsiento{
        private int $id_reserva;
        private int $id_asiento;

        /**
         * @brief Constructor de la clase ReservaAsiento
         * @param int $id_reserva ID de la reserva
         * @param int $id_asiento ID del asiento reservado
         */
        public function __construct(int $id_reserva, int $id_asiento){
            $this->id_reserva = $id_reserva;
            $this->id_asiento = $id_asiento;
        }

        /**
         * @brief Destructor de la clase ReservaAsiento
         */
        public function __destruct(){
            $this->id_reserva = 0;
            $this->id_asiento = 0;
        }

        /**
         * @brief Inserta una relación entre una reserva y un asiento en la base de datos
         * @return bool True si se insertó correctamente, False si ocurrió un error
         */
        public function crearReservaAsiento(){
            $registro = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO reserva_asiento (id_reserva, id_asiento)
                    VALUES (?,?)");

                $consulta->bindParam(1, $this->id_reserva);
                $consulta->bindParam(2, $this->id_asiento);

                $consulta->execute();
                $registro = true;
                return $registro;
            } catch(PDOException $e){
                echo "Error al hacer la creación de la reserva_asiento " . $e->getMessage();
                return $regsitro;
            }
        }

        /**
         * @brief Obtiene los asientos ocupados en una sesión específica
         * @param int $id_sesion ID de la sesión
         * @return array Array de asientos reservados (solo los ID)
         */
        public static function obtenerAsientosOcupados(int $id_sesion){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT a.id_asiento FROM reserva_asiento AS ra
                    INNER JOIN reserva AS r ON ra.id_reserva = r.id_reserva
                    INNER JOIN asiento AS a ON ra.id_asiento = a.id_asiento
                    WHERE r.id_sesion = (?)");
                
                $consulta->bindParam(1, $id_sesion);
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $asientosReservados = [];

                while ($asiento = $consulta->fetch()){
                    $asientosReservados[] = $asiento;
                }

                return $asientosReservados;
            }
            catch (PDOException $e){
                echo "Error al mostrar los asientos reservados " . $e->getMessage();
                return $asientosReservados = [];
            }
        }

        /**
         * @brief Obtiene los datos (fila y número) de los asientos asociados a una reserva
         * @param int $id_reserva ID de la reserva
         * @return array Array de asientos con fila y número
         */
        public static function getAsientosByReserva(int $id_reserva){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT a.fila, a.numero  
                    FROM reserva_asiento ra
                    JOIN asiento a ON ra.id_asiento = a.id_asiento
                    WHERE ra.id_reserva = (?)");
                
                $consulta->bindParam(1, $id_reserva);
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $asientosReservados = [];

                while ($asiento = $consulta->fetch()){
                    $asientosReservados[] = $asiento;
                }

                return $asientosReservados;
            }
            catch (PDOException $e){
                echo "Error al mostrar los asientos reservados " . $e->getMessage();
                return $asientosReservados = [];
            }
        }
    }
?>