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

        public static function getSesionesById(int $id_pelicula, string $fecha){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sesion WHERE id_pelicula = '$id_pelicula' AND DATE(fecha_hora) = '$fecha'");
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

        public static function getDatosSesion(int $id_sesion){
            
            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM sesion WHERE id_sesion = '$id_sesion'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesion = $consulta->fetch();

                return $sesion;
            }
            catch(PDOException $e){
                echo "Error al buscar la sesion " . $e->getMessage();
            }
        }

        public static function desplegarSesiones() {

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT s.id_sesion, p.titulo AS pelicula, sa.nombre AS sala, s.fecha_hora 
                    FROM sesion s
                    JOIN pelicula p ON s.id_pelicula = p.id_pelicula
                    JOIN sala sa ON s.id_sala = sa.id_sala
                    ORDER BY s.fecha_hora ASC
                ");
                $consulta->fetchAll(PDO::FETCH_ASSOC);
                $consulta->execute();

                $sesiones = [];

                while ($sesion = $consulta->fetch()){
                    $sesiones[] = $sesion;
                }

                return $sesiones;
            } 
            catch (PDOException $e) {
                echo "Error al mostrar las sesiones " . $e->getMessage();
                return $sesiones = [];
            }
        }

        public static function eliminarSesion(int $idSesion) {
            $borrado = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM sesion WHERE id_sesion = (?)");
                $consulta->bindParam(1, $idSesion);
                $consulta->execute();

                $borrado = true;
                return $borrado;
            } 
            catch (PDOException $e) {
                echo "Error al eliminar sesión: " . $e->getMessage();
                return $borrado;
            }
        }
    }

?>