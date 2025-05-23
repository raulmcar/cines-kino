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
    }
?>