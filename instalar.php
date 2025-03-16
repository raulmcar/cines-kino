<?php
    session_start();
    $usuario = "root";
    $password = "Furciademierda4";
    $host = "localhost";

    try {
        $bdConexion = new PDO("mysql:host=$host", $usuario, $password);

        $bdConexion->exec("CREATE DATABASE IF NOT EXISTS cine;");

        $bdConexion->exec("USE cine;");

        $bdConexion->beginTransaction();

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS usuario(
            id_usuario INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            apellidos VARCHAR(100),
            email VARCHAR(100),
            contrasena VARCHAR(50),
            telefono INT(9),
            dni VARCHAR(9),
            fecha_nacimiento VARCHAR(10),
            tipo_usuario VARCHAR(10));");

        






    }






?>