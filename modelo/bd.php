<?php
    /**
     * @file bd.php
     * @brief Contiene la clase Reserva para la gestión de conexiones en la base de datos.
     */

    /**
     * @class BD
     * @brief Clase encargada de gestionar la conexión con la base de datos mediante PDO.
     */
    class BD{
        private ?PDO $pdo;

        /**
         * @brief Constructor de la clase BD.
         * Establece la conexión con la base de datos MySQL utilizando PDO.
         */
        public function __construct(){
            $usuario = "root";
            $password = "password1";
            $dsn = "mysql:host=localhost;dbname=cine";
            $this->pdo = new PDO($dsn, $usuario, $password);
        }

        /**
         * @brief Destructor de la clase BD.
         * Cierra la conexión con la base de datos.
         */
        public function __destruct(){
            $this->pdo = null;
        }

        /**
         * @brief Devuelve la instancia de PDO.
         * @return PDO|null Objeto PDO que representa la conexión con la base de datos.
         */
        public function getPDO(){
            return $this->pdo;
        }
    }
?>