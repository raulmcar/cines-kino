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

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS reserva(
            id_reserva INT PRIMARY KEY AUTO_INCREMENT,
            id_usuario INT(5),
            id_sesion INT(5),
            id_asiento_sesion(5),
            precio FLOAT(10),
            fecha_reserva VARCHAR(10));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS pago(
            id_pago INT PRIMARY KEY AUTO_INCREMENT,
            id_reserva INT(5),
            metodo_pago VARCHAR(30),
            estado VARCHAR(30));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS asiento_sesion(
            id_asiento_sesion INT PRIMARY KEY AUTO_INCREMENT,
            id_asiento INT(5),
            id_sesion INT(5),
            estado VARCHAR(30));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS sesion(
            id_sesion INT PRIMARY KEY AUTO_INCREMENT,
            id_pelicula INT(5),
            id_sala INT(5),
            fecha_hora VARCHAR(10));");
        
        $bdConexion->exec("CREATE TABLE IF NOT EXISTS pelicula(
            id_pelicula INT PRIMARY KEY AUTO_INCREMENT,
            titulo VARCHAR(50),
            sinopsis VARCHAR(300),
            duracion VARCHAR(20),
            genero VARCHAR(30),
            clasificacion VARCHAR(30),
            imagen VARCHAR(100));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS sala(
            id_sala INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(20),
            capacidad INT(3));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS asiento(
            id_asiento INT PRIMARY KEY AUTO_INCREMENT,
            id_sala INT(5),
            fila INT(2),
            numero INT(2));");
        
        




    }






?>