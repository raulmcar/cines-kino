<?php
    require_once('bd.php');

    class Reserva{
        private int $id_usuario;
        private int $id_sesion;
        private float $precio;
        private string $fechaReserva;

        public function __construct(int $id_usuario, int $id_sesion, float $precio, string $fechaReserva){
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

        public function crearReserva(){

        }







    }

?>