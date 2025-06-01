<?php
    /**
     * @file Reserva.php
     * @brief Contiene la clase Reserva para la gestión de reservas en la base de datos.
     */

    require_once('bd.php');

    /**
     * @class Reserva
     * @brief Clase que representa una reserva realizada por un usuario para una sesión.
     */
    class Reserva{
        private ?int $id_reserva;
        private ?int $id_usuario;
        private int $id_sesion;
        private float $precio;
        private string $fechaReserva;

        /**
         * @brief Constructor de la clase Reserva
         * @param int|null $id_usuario ID del usuario (puede ser null si es anónimo)
         * @param int $id_sesion ID de la sesión
         * @param float $precio Precio total de la reserva
         * @param string $fechaReserva Fecha de la reserva (en formato YYYY-MM-DD)
         */
        public function __construct(?int $id_usuario, int $id_sesion, float $precio, string $fechaReserva){
            $this->id_reserva = null;
            $this->id_usuario = $id_usuario;
            $this->id_sesion = $id_sesion;
            $this->precio = $precio;
            $this->fechaReserva = $fechaReserva;
        }

        /**
         * @brief Destructor de la clase Reserva
         */
        public function __destruct(){
            $this->id_reserva = null;
            $this->id_usuario = 0;
            $this->id_sesion = 0;
            $this->precio = 0;
            $this->fechaReserva = "";
        }

        /**
         * @brief Obtiene el ID de la reserva
         * @return int|null ID de la reserva
         */
        public function getId(){
            return $this->id_reserva;
        }

        /**
         * @brief Inserta una nueva reserva en la base de datos
         * @return bool True si la reserva se creó con éxito, False en caso de error
         */
        public function crearReserva() {
            $registro = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO reserva (id_usuario, id_sesion, precio, fecha_reserva)
                    VALUES (?,?,?,?)");

                if ($this->id_usuario === null) {
                    $consulta->bindValue(1, null);
                } else {
                    $consulta->bindValue(1, $this->id_usuario);
                }

                $consulta->bindParam(2, $this->id_sesion);
                $consulta->bindParam(3, $this->precio);
                $consulta->bindParam(4, $this->fechaReserva);

                $consulta->execute();

                $this->id_reserva = $bdConexion->lastInsertId();
                $registro = true;
                return $registro;
            } catch (PDOException $e) {
                echo "Error al hacer la reserva: " . $e->getMessage();
                return $registro;
            }
        }

        /**
         * @brief Obtiene todas las reservas asociadas a un usuario
         * @param int $id_usuario ID del usuario
         * @return array Array de reservas asociadas al usuario
         */
        public static function getReservasByIdUser(int $id_usuario){

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM reserva WHERE id_usuario = '$id_usuario'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $reservas = [];

                while ($reserva = $consulta->fetch()){
                    $reservas[] = $reserva;
                }

                return $reservas;
            }
            catch(PDOException $e){
                echo "Error al mostrar las salas " . $e->getMessage();
                return $reservas = [];
            }
        }

        /**
         * @brief Obtiene una reserva específica por su ID
         * @param int $id_reserva ID de la reserva
         * @return array|null Array asociativo con los datos de la reserva o null si no se encuentra
         */
        public static function getReservaById(int $id_reserva){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM reserva WHERE id_reserva = '$id_reserva'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $reserva = $consulta->fetch();

                return $reserva;
            }          
            catch(PDOException $e){
                echo "Error al buscar la reserva " . $e->getMessage();
            }
        }
    }
?>