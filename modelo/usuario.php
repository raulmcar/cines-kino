<?php
    require_once('bd.php');

    class Usuario{
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $contrasena;
        private string $telefono;
        private string $dni;
        private string $fecha_nacimiento;
        private string $tipo_usuario;

        public function __construct(string $nombre, string $apellidos, string $email, string $contrasena, string $telefono, 
        string $dni, string $fecha_nacimiento, string $tipo_usuario){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
            $this->telefono = $telefono;
            $this->dni = $dni;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->tipo_usuario = $tipo_usuario;
        }

        public function __destruct(){
            $this->nombre = "";
            $this->apellidos = "";
            $this->email = "";
            $this->contrasena = "";
            $this->telefono = "";
            $this->dni = "";
            $this->fecha_nacimiento = "";
            $this->tipo_usuario = "";
        }

        


    }
?>