<?php
    require_once('bd.php');

    class Asiento{
        private int $idSala;
        private int $fila;
        private int $numero;

        public function __construct(int $fila, int $numero){
            $this->idSala = $idSala;
            $this->fila = $fila;
            $this->numero = $numero;
        }

        public function __destruct(){
            $this->idSala = 0;
            $this->fila = 0;
            $this->numero = 0;
        }

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
    }






?>