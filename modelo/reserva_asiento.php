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
    }
?>