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
            contrasena VARCHAR(100),
            telefono INT(9),
            dni VARCHAR(9),
            fecha_nacimiento VARCHAR(10),
            tipo_usuario VARCHAR(10));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS reserva(
            id_reserva INT PRIMARY KEY AUTO_INCREMENT,
            id_usuario INT(5),
            id_sesion INT(5),
            precio FLOAT(10),
            fecha_reserva DATETIME);");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS pago(
            id_pago INT PRIMARY KEY AUTO_INCREMENT,
            id_reserva INT(5),
            metodo_pago VARCHAR(30),
            estado VARCHAR(30));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS sesion(
            id_sesion INT PRIMARY KEY AUTO_INCREMENT,
            id_pelicula INT(5),
            id_sala INT(5),
            fecha_hora DATETIME);");
        
        $bdConexion->exec("CREATE TABLE IF NOT EXISTS pelicula(
            id_pelicula INT PRIMARY KEY AUTO_INCREMENT,
            titulo VARCHAR(50),
            sinopsis VARCHAR(2000),
            duracion VARCHAR(20),
            genero VARCHAR(30),
            clasificacion VARCHAR(30),
            imagen VARCHAR(100));");
            // trailer ????
            // director
            // anio
            // estreno : bool

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS sala(
            id_sala INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(20),
            capacidad INT(3));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS asiento(
            id_asiento INT PRIMARY KEY AUTO_INCREMENT,
            id_sala INT(5),
            fila INT(2),
            numero INT(2));");
            // estado (comprado o libre)

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS reserva_asiento(
            id_reserva_asiento INT PRIMARY KEY AUTO_INCREMENT,
            id_reserva INT(5),
            id_asiento INT(5));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS comentario(
            id_comentario INT PRIMARY KEY AUTO_INCREMENT,
            id_usuario INT(5),
            id_pelicula INT(5),
            valoracion INT(5),
            texto_comentario VARCHAR(2000));");
        
        $bdConexion->exec("ALTER TABLE reserva ADD FOREIGN KEY(id_usuario)
            REFERENCES usuario(id_usuario) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE reserva ADD FOREIGN KEY(id_sesion)
            REFERENCES sesion(id_sesion) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE pago ADD FOREIGN KEY(id_reserva)
            REFERENCES reserva(id_reserva) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE sesion ADD FOREIGN KEY(id_pelicula)
            REFERENCES pelicula(id_pelicula) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE sesion ADD FOREIGN KEY(id_sala)
            REFERENCES sala(id_sala) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE asiento ADD FOREIGN KEY(id_sala)
            REFERENCES sala(id_sala) ON DELETE CASCADE;");
        
        $bdConexion->exec("ALTER TABLE reserva_asiento ADD FOREIGN KEY(id_reserva)
            REFERENCES reserva(id_reserva) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE reserva_asiento ADD FOREIGN KEY(id_asiento)
            REFERENCES asiento(id_asiento) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE comentario ADD FOREIGN KEY(id_usuario)
            REFERENCES usuario(id_usuario) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE comentario ADD FOREIGN KEY(id_usuario)
            REFERENCES pelicula(id_pelicula) ON DELETE CASCADE;");

        $bdConexion->commit();
        $bdConexion = null;
        echo "Se ha completado la instalación correctamente.";
    }
    catch (PDOException $e) {
        $bdConexion->rollback();
        $bdConexion = null;
        echo "Error en la instalacion: " . $e->getMessage();
    }
?>