<?php
    /**
     * @file Pelicula.php
     * @brief Contiene la clase Reserva para la gestión de peliculas en la base de datos.
     */
    require_once('bd.php');

    /**
     * @class Pelicula
     * @brief Clase que representa una película y permite operaciones CRUD sobre ella.
     */
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

        /**
         * @brief Constructor de la clase Pelicula.
         * @param titulo Título de la película.
         * @param sinopsis Sinopsis de la película.
         * @param duracion Duración de la película.
         * @param genero Género de la película.
         * @param clasificacion Clasificación por edades.
         * @param imagen Ruta o nombre de la imagen del cartel.
         * @param director Director de la película.
         * @param anio Año de la película.
         * @param estreno Indica si es estreno.
         */
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

        /**
         * @brief Destructor de la clase Pelicula.
         * Libera los valores asignados a los atributos.
         */
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

        /**
         * @brief Registra una nueva película en la base de datos.
         * @return bool true si se ha registrado correctamente, false en caso contrario.
         */
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

        /**
         * @brief Comprueba si existe una película con el título especificado.
         * @param pelicula Título a comprobar.
         * @return bool true si existe, false si no.
         */
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

        /**
         * @brief Devuelve todas las películas registradas.
         * @return array Lista de películas como arrays asociativos.
         */
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

        /**
         * @brief Devuelve las películas que son estrenos.
         * @return array Lista de películas marcadas como estrenos (hasta 7).
         */
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

        /**
         * @brief Devuelve los datos de una película por su ID.
         * @param id_pelicula ID de la película a consultar.
         * @return array|null Datos de la película o null si no se encuentra.
         */
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

        /**
         * @brief Actualiza los datos principales de una película.
         * @param id_pelicula ID de la película a actualizar.
         * @param newnombre Nuevo título.
         * @param newduracion Nueva duración.
         * @param newgenero Nuevo género.
         * @param newdirector Nuevo director.
         * @return bool true si se actualizó correctamente, false en caso de error.
         */
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

        /**
         * @brief Elimina una película por su ID.
         * @param id_pelicula ID de la película a eliminar.
         * @return bool true si se eliminó correctamente, false si no.
         */
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