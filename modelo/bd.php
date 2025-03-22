<?php
    class BD{
        private ?PDO $pdo;

        public function __construct(){
            $usuario = "root";
            $password = "Furciademierda4";
            $dsn = "mysql:host=localhost;dbname=cine";
            $this->pdo = new PDO($dsn, $usuario, $password);
        }

        public function __destruct(){
            $this->pdo = null;
        }

        public function getPDO(){
            return $this->pdo;
        }
    }
?>