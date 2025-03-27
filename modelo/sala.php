<?php
    require_once('bd.php');

    class Sala{
        private string $nombre;
        private int $capacidad;
        private ?array $asientos;

        public function __construct(string $nombre, int $capcadidad){
            $this->nombre = $nombre;
            $this->capacidad = $capacidad;
            $this->asientos = [];
        }

        public function __destruct(){
            $this->nombre = "";
            $this->capacidad = 0;
            $this->asientos = [];
        }

        public function registrarSala(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO sala(nombre, capacidad)
                    VALUES (?,?)");

                $consulta->bindParam(1, $this->nombre);
                $consulta->bindParam(2, $this->capacidad);

                $consulta->execute();
                $registro = true;
                return $registro;
                unset($bdConexion);
            }
            catch(PDOException $e) {
                echo "Error al insertar los datos: " . $e->getMessage();
                return $registro;
            } 
        }
        
        public function comprobarSala(string $sala){
            $existe = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT nombre FROM sala WHERE nombre = '$sala'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $fila = $consulta->fetch();

                if ($fila){
                    $existe = true;
                } else {
                    $existe = false;
                }

            }
            catch(PDOException $e){
                echo "Error al consultar los datos: " . $e->getMessage();
            }

            return $existe;
        }

        public static function desplegarSalas(){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sala");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $salas = [];

                while ($sala = $consulta->fetch()){
                    $salas[] = $sala;
                }

                return $salas;
            }
            catch(PDOException $e){
                echo "Error al mostrar las salas " . $e->getMessage();
                return $salas = [];
            }
        }
    }
?>