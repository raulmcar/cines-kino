<?php
    require_once('bd.php');

    class Reserva{
        private ?int $id_usuario;
        private int $id_sesion;
        private float $precio;
        private string $fechaReserva;

        public function __construct(?int $id_usuario, int $id_sesion, float $precio, string $fechaReserva){
            $this->id_usuario = $id_usuario;
            $this->id_sesion = $id_sesion;
            $this->precio = $precio;
            $this->fechaReserva = $fechaReserva;
        }

        public function __destruct(){
            $this->id_usuario = 0;
            $this->id_sesion = 0;
            $this->precio = 0;
            $this->fechaReserva = "";
        }

        public function crearReserva() {
            $registro = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO reserva (id_usuario, id_sesion, precio, fecha_reserva)
                    VALUES (?, ?, ?, ?)");

                if ($this->id_usuario === null) {
                    $consulta->bindValue(1, null);
                } else {
                    $consulta->bindValue(1, $this->id_usuario);
                }

                $consulta->bindParam(2, $this->id_sesion);
                $consulta->bindParam(3, $this->precio);
                $consulta->bindParam(4, $this->fechaReserva);

                $consulta->execute();
                $registro = true;
                return $registro;
            } catch (PDOException $e) {
                echo "Error al hacer la reserva: " . $e->getMessage();
                return $registro;
            }
        }
    }
?>