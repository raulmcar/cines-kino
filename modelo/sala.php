<?php
    require_once('bd.php');

    class Sala{
        private string $nombre;
        private int $capacidad;

        public function __construct(string $nombre){
            $this->nombre = $nombre;
        }

        public function __destruct(){
            $this->nombre = "";
        }

        public function registrarSala(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO sala(nombre)
                    VALUES (?)");

                $consulta->bindParam(1, $this->nombre);

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

        public static function actualizarSala($idSala, $nuevoNombre) {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("UPDATE sala SET nombre = (?) WHERE id_sala = (?)");
                $consulta->bindParam(1, $nuevoNombre);
                $consulta->bindParam(2, $idSala);

                return $consulta->execute(); 
            } 
            catch (PDOException $e) {
                error_log("Error en actualizarSala: " . $e->getMessage());
                return false;
            }
        }

        public static function eliminarSala($idSala) {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM sala WHERE id_sala = (?)");
                $consulta->bindParam(1, $idSala);

                return $consulta->execute();
            } 
            catch (PDOException $e) {
                error_log("Error en eliminarSala: " . $e->getMessage());
                return false;
            }
        }
    }
?>