<?php
    require_once('bd.php');

    class Pelicula{
        private string $titulo;
        private string $sinopsis;
        private int $duracion;
        private string $genero;
        private int $clasificacion;
        private string $imagen;
        private string $director;
        private int $anio;
        private bool $estreno;

        public function __construct(string $titulo, string $sinopsis, string $duracion, string $genero, string $clasificacion,
        string $imagen, string $director, int $anio, bool $estreno){
            $this->titulo = $titulo;
            $this->sinopsis = $sinopsis;
            $this->duracion = $duracion;
            $this->genero = $genero;
            $this->clasificacion = $clasificacion;
            $this->imagen = $imagen;
            $this->director = $director;
            $this->anio = $anio;
            $this->estreno = $estreno;
        }

        public function __destruct(){
            $this->titulo = "";
            $this->sinopsis = "";
            $this->duracion = 0;
            $this->genero = "";
            $this->clasificacion = 0;
            $this->imagen = "";
            $this->director = "";
            $this->anio = 0;
            $this->estreno = false;
        }

        public function registrarPelicula(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO pelicula(titulo, sinopsis, duracion, genero, clasificacion, imagen, 
                    director, anio, estreno) VALUES (?,?,?,?,?,?,?,?,?)");

                $consulta->bindParam(1, $this->titulo);
                $consulta->bindParam(2, $this->sinopsis);
                $consulta->bindParam(3, $this->duracion);
                $consulta->bindParam(4, $this->genero);
                $consulta->bindParam(5, $this->clasificacion);
                $consulta->bindParam(6, $this->imagen);
                $consulta->bindParam(7, $this->director);
                $consulta->bindParam(8, $this->anio);
                $consulta->bindParam(9, $this->estreno);

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

        public function comprobarPelicula(string $pelicula){
            $existe = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT titulo FROM pelicula WHERE titulo = '$pelicula'");
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

        public static function desplegarPeliculas(){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM pelicula");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $pelis = [];

                while ($peli = $consulta->fetch()){
                    $pelis[] = $peli;
                }

                return $pelis;
            }
            catch(PDOException $e){
                echo "Error al mostrar las peliculas " . $e->getMessage();
                return $pelis = [];
            }
        }

        public static function desplegarEstrenos(){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM pelicula WHERE estreno = 1 ORDER BY id_pelicula DESC LIMIT 7");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $pelis = [];

                while ($peli = $consulta->fetch()){
                    $pelis[] = $peli;
                }

                return $pelis;
            }
            catch(PDOException $e){
                echo "Error al mostrar las peliculas " . $e->getMessage();
                return $pelis = [];
        }
        }

        public static function getPeliculaById(int $id_pelicula){

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("SELECT * FROM pelicula WHERE id_pelicula = '$id_pelicula'");
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $consulta->execute();

                $pelicula = $consulta->fetch();

                return $pelicula;
            }
            catch(PDOException $e){
                echo "Error al buscar la pelicula " . $e->getMessage();
            }
        }

        public static function actualizarPelicula(int $id_pelicula, string $newnombre, int $newduracion, string $newgenero, string $newdirector) {
            $actualizado = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("UPDATE pelicula SET titulo = '$newnombre', duracion = '$newduracion',
                    genero = '$newgenero', director = '$newdirector' WHERE id_pelicula = '$id_pelicula'");
                $consulta->execute();

                $actualizado = true;
                return $actualizado;
                unset($bdConexion);
            } 
            catch (PDOException $e) {
                echo "Ha habido un error al actualizar la película: " . $e->getMessage();
                return $actualizado;
            }
        }

        public static function eliminarPelicula(int $id_pelicula) {
            $borrado = false;

            try {
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();
                $consulta = $bdConexion->prepare("DELETE FROM pelicula WHERE id_pelicula = (?)");
                $consulta->bindParam(1, $id_pelicula);
                $consulta->execute();

                $borrado = true;
                return $borrado;

                unset($bdConexion);
            } 
            catch (PDOException $e) {
                echo "Ha habido un error al eliminar la película: " . $e->getMessage();
                return $borrado;
            }
        }
    }
?>