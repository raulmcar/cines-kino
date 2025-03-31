<?php
    require_once('bd.php');

    class Pelicula{
        private string $titulo;
        private string $sinopsis;
        private int $duracion;
        private string $genero;
        private int $clasificacion;
        private string $imagen;


        public function __construct(string $titulo, string $sinopsis, string $duracion, string $genero, string $clasificacion,
        string $imagen){
            $this->titulo = $titulo;
            $this->sinopsis = $sinopsis;
            $this->duracion = $duracion;
            $this->genero = $genero;
            $this->clasificacion = $clasificacion;
            $this->imagen = $imagen;
        }

        public function __destruct(){
            $this->titulo = "";
            $this->sinopsis = "";
            $this->duracion = 0;
            $this->genero = "";
            $this->clasificacion = 0;
            $this->imagen = "";
        }

        public function registrarPelicula(){
            $registro = false;

            try{
                $pdo = new BD();
                $bdConexion = $pdo->getPDO();

                $consulta = $bdConexion->prepare("INSERT INTO pelicula(titulo, sinopsis, duracion, genero, clasificacion, imagen)
                    VALUES (?,?,?,?,?,?)");

                $consulta->bindParam(1, $this->titulo);
                $consulta->bindParam(2, $this->sinopsis);
                $consulta->bindParam(3, $this->duracion);
                $consulta->bindParam(4, $this->genero);
                $consulta->bindParam(5, $this->clasificion);
                $consulta->bindParam(6, $this->imagen);

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
    }

?>