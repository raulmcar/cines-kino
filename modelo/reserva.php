<?php
    require_once('bd.php');

    class Reserva{
        private ?int $id_reserva;
        private ?int $id_usuario;
        private int $id_sesion;
        private float $precio;
        private string $fechaReserva;

        public function __construct(?int $id_usuario, int $id_sesion, float $precio, string $fechaReserva){
            $this->id_reserva = null;
            $this->id_usuario = $id_usuario;
            $this->id_sesion = $id_sesion;
            $this->precio = $precio;
            $this->fechaReserva = $fechaReserva;
        }

        public function __destruct(){
            $this->id_reserva = null;
            $this->id_usuario = 0;
            $this->id_sesion = 0;
            $this->precio = 0;
            $this->fechaReserva = "";
        }

        public function getId(){
            return $this->id_reserva;
        }

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