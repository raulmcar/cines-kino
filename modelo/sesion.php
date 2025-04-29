<?php
    require_once('bd.php');

    class Sesion{
        private int $idPelicula;
        private int $idSala;
        private string $fechaSesion;

        public function __construct(int $idPelicula, int $idSala, string $fechaSesion){
            $this->idPelicula = $idPelicula;
            $this->idSala = $idSala;
            $this->fechaSesion = $fechaSesion;
        }

        public function __destruct(){
            $this->idPelicula = 0;
            $this->idSala = 0;
            $this->fechaSesion = "";
        }

        public function registrarSesion(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO sesion(id_pelicula, id_sala, fecha_hora)
                    VALUES (?,?,?)");
                
                $consulta->bindParam(1, $this->idPelicula);
                $consulta->bindParam(2, $this->idSala);
                $consulta->bindParam(3, $this->fechaSesion);

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

        public static function getSesionesById(int $id_pelicula){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sesion WHERE id_pelicula = '$id_pelicula'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesiones = [];

                while ($sesion = $consulta->fetch()){
                    $sesiones[] = $sesion;
                }

                return $sesiones;
            }
            catch(PDOException $e){
                echo "Error al mostrar las sesiones " . $e->getMessage();
                return $sesiones = [];
            }
        }

    }

?>