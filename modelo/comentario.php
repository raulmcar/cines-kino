<?php
    require_once('bd.php');

    class Comentario{
        private int $id_usuario;
        private int $id_pelicula;
        private int $valoracion;
        private string $texto_comentario;

        public function __construct(int $id_usuario, int $id_pelicula, int $valoracion, string $texto_comentario){
            $this->id_usuario = $id_usuario;
            $this->id_pelicula = $id_pelicula;
            $this->valoracion = $valoracion;
            $this->texto_comentario = $texto_comentario;
        }

        public function __destruct(){
            $this->id_usuario = 0;
            $this->id_pelicula = 0;
            $this->valoracion = 0;
            $this->texto_comentario = "";
        }

        public function insertarComentario(){

        }

        public static function getComentariosByIdMovie(int $id_pelicula){

        }

    }
?>