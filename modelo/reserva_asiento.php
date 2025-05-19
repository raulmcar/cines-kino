<?php
    require_once('bd.php');

    class ReservaAsiento{
        private int $id_reserva;
        private int $id_asiento;

        public function __construct(int $id_reserva, int $id_asiento){
            $this->id_reserva = $id_reserva;
            $this->id_asiento = $id_asiento;
        }

        public function __destruct(){
            $this->id_reserva = 0;
            $this->id_asiento = 0;
        }

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
    }
?>