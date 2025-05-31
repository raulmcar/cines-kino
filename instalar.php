<?php
    session_start();
    $usuario = "root";
    $password = "password1";
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
            imagen VARCHAR(100),
            director VARCHAR(100),
            anio INT(5),
            estreno BOOLEAN);");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS sala(
            id_sala INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(20));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS asiento(
            id_asiento INT PRIMARY KEY AUTO_INCREMENT,
            id_sala INT(5),
            fila INT(2),
            numero INT(2));");

        $bdConexion->exec("CREATE TABLE IF NOT EXISTS reserva_asiento(
            id_reserva_asiento INT PRIMARY KEY AUTO_INCREMENT,
            id_reserva INT(5),
            id_asiento INT(5));");
        
        $bdConexion->exec("ALTER TABLE reserva ADD FOREIGN KEY(id_usuario)
            REFERENCES usuario(id_usuario) ON DELETE CASCADE;");

        $bdConexion->exec("ALTER TABLE reserva ADD FOREIGN KEY(id_sesion)
            REFERENCES sesion(id_sesion) ON DELETE CASCADE;");

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

        $bdConexion->exec("INSERT INTO sala (nombre) VALUES
            ('Sala 1'),
            ('Sala 2'),
            ('Sala 3'),
            ('Sala 4'),
            ('Sala 5');
            ");

        $bdConexion->exec("INSERT INTO asiento (id_sala, fila, numero) VALUES
            (1,1,1),(1,1,2),(1,1,3),(1,1,4),(1,1,5),(1,1,6),(1,1,7),(1,1,8),(1,1,9),(1,1,10),
            (1,2,1),(1,2,2),(1,2,3),(1,2,4),(1,2,5),(1,2,6),(1,2,7),(1,2,8),(1,2,9),(1,2,10),
            (1,3,1),(1,3,2),(1,3,3),(1,3,4),(1,3,5),(1,3,6),(1,3,7),(1,3,8),(1,3,9),(1,3,10),
            (1,4,1),(1,4,2),(1,4,3),(1,4,4),(1,4,5),(1,4,6),(1,4,7),(1,4,8),(1,4,9),(1,4,10),
            (1,5,1),(1,5,2),(1,5,3),(1,5,4),(1,5,5),(1,5,6),(1,5,7),(1,5,8),(1,5,9),(1,5,10);");
        
        $bdConexion->exec("INSERT INTO asiento (id_sala, fila, numero) VALUES
            (2,1,1),(2,1,2),(2,1,3),(2,1,4),(2,1,5),(2,1,6),(2,1,7),(2,1,8),
            (2,2,1),(2,2,2),(2,2,3),(2,2,4),(2,2,5),(2,2,6),(2,2,7),(2,2,8),
            (2,3,1),(2,3,2),(2,3,3),(2,3,4),(2,3,5),(2,3,6),(2,3,7),(2,3,8),
            (2,4,1),(2,4,2),(2,4,3),(2,4,4),(2,4,5),(2,4,6),(2,4,7),(2,4,8),
            (2,5,1),(2,5,2),(2,5,3),(2,5,4),(2,5,5),(2,5,6),(2,5,7),(2,5,8),
            (2,6,1),(2,6,2),(2,6,3),(2,6,4),(2,6,5),(2,6,6),(2,6,7),(2,6,8),
            (2,7,1),(2,7,2),(2,7,3),(2,7,4),(2,7,5),(2,7,6),(2,7,7),(2,7,8);");

        $bdConexion->exec("INSERT INTO asiento (id_sala, fila, numero) VALUES
            (3,1,1),(3,1,2),(3,1,3),(3,1,4),(3,1,5),(3,1,6),(3,1,7),(3,1,8),(3,1,9),(3,1,10),(3,1,11),(3,1,12),
            (3,2,1),(3,2,2),(3,2,3),(3,2,4),(3,2,5),(3,2,6),(3,2,7),(3,2,8),(3,2,9),(3,2,10),(3,2,11),(3,2,12),
            (3,3,1),(3,3,2),(3,3,3),(3,3,4),(3,3,5),(3,3,6),(3,3,7),(3,3,8),(3,3,9),(3,3,10),(3,3,11),(3,3,12),
            (3,4,1),(3,4,2),(3,4,3),(3,4,4),(3,4,5),(3,4,6),(3,4,7),(3,4,8),(3,4,9),(3,4,10),(3,4,11),(3,4,12),
            (3,5,1),(3,5,2),(3,5,3),(3,5,4),(3,5,5),(3,5,6),(3,5,7),(3,5,8),(3,5,9),(3,5,10),(3,5,11),(3,5,12),
            (3,6,1),(3,6,2),(3,6,3),(3,6,4),(3,6,5),(3,6,6),(3,6,7),(3,6,8),(3,6,9),(3,6,10),(3,6,11),(3,6,12);");

        $bdConexion->exec("INSERT INTO asiento (id_sala, fila, numero) VALUES
            (4,1,1),(4,1,2),(4,1,3),(4,1,4),(4,1,5),(4,1,6),(4,1,7),(4,1,8),(4,1,9),
            (4,2,1),(4,2,2),(4,2,3),(4,2,4),(4,2,5),(4,2,6),(4,2,7),(4,2,8),(4,2,9),
            (4,3,1),(4,3,2),(4,3,3),(4,3,4),(4,3,5),(4,3,6),(4,3,7),(4,3,8),(4,3,9),
            (4,4,1),(4,4,2),(4,4,3),(4,4,4),(4,4,5),(4,4,6),(4,4,7),(4,4,8),(4,4,9);");

        $bdConexion->exec("INSERT INTO asiento (id_sala, fila, numero) VALUES
            (5,1,1),(5,1,2),(5,1,3),(5,1,4),(5,1,5),(5,1,6),(5,1,7),(5,1,8),(5,1,9),(5,1,10),
            (5,2,1),(5,2,2),(5,2,3),(5,2,4),(5,2,5),(5,2,6),(5,2,7),(5,2,8),(5,2,9),(5,2,10),
            (5,3,1),(5,3,2),(5,3,3),(5,3,4),(5,3,5),(5,3,6),(5,3,7),(5,3,8),(5,3,9),(5,3,10),
            (5,4,1),(5,4,2),(5,4,3),(5,4,4),(5,4,5),(5,4,6),(5,4,7),(5,4,8),(5,4,9),(5,4,10),
            (5,5,1),(5,5,2),(5,5,3),(5,5,4),(5,5,5),(5,5,6),(5,5,7),(5,5,8),(5,5,9),(5,5,10),
            (5,6,1),(5,6,2),(5,6,3),(5,6,4),(5,6,5),(5,6,6),(5,6,7),(5,6,8),(5,6,9),(5,6,10),
            (5,7,1),(5,7,2),(5,7,3),(5,7,4),(5,7,5),(5,7,6),(5,7,7),(5,7,8),(5,7,9),(5,7,10),
            (5,8,1),(5,8,2),(5,8,3),(5,8,4),(5,8,5),(5,8,6),(5,8,7),(5,8,8),(5,8,9),(5,8,10);");

        $bdConexion->exec("INSERT INTO pelicula (titulo, sinopsis, duracion, genero, clasificacion, imagen, director, anio, estreno) VALUES
            ('El señor de los anillos', 'En un mundo mítico conocido como la Tierra Media, un joven hobbit llamado Frodo Bolsón se convierte en el inesperado portador del Anillo Único.', '180 min', 'Aventuras', '+12', '../imagenes/carteles/El señor de los anillos.jpg', 'Peter Jackson', 2001, 1),
            ('Dune Parte Dos', 'Paul Atreides se une a los Fremen para vengar a su familia y evitar el terrible futuro que ha previsto.', '166 min', 'Ciencia ficción', '+12', '../imagenes/carteles/Dune Parte Dos.jpg', 'Denis Villeneuve', 2024, 1),
            ('Godzilla y Kong El Nuevo Imperio', 'Godzilla y Kong se enfrentan a una nueva amenaza colosal bajo la superficie de la Tierra.', '115 min', 'Acción', '+12', '../imagenes/carteles/Godzilla y Kong El Nuevo Imperio.jpg', 'Adam Wingard', 2024, 1),
            ('El especialista', 'Un especialista de cine se ve envuelto en una trama criminal tras un accidente en el rodaje.', '126 min', 'Comedia', '+16', '../imagenes/carteles/El especialista.jpg', 'David Leitch', 2024, 1),
            ('Cazafantasmas Imperio Helado', 'La familia Spengler regresa a Nueva York para enfrentarse a una nueva amenaza fantasmal.', '110 min', 'Fantasía', '+7', '../imagenes/carteles/Cazafantasmas Imperio Helado.jpg', 'Gil Kenan', 2024, 1),
            ('Kung Fu Panda 4', 'Po debe encontrar al próximo Guerrero Dragón mientras enfrenta un nuevo enemigo mágico.', '94 min', 'Animación', 'TP', '../imagenes/carteles/Kung Fu Panda 4.jpg', 'Mike Mitchell', 2024, 1),
            ('Back to Black', 'La historia de vida de la cantante Amy Winehouse, desde sus inicios hasta su trágico final.', '122 min', 'Biografía', '+16', '../imagenes/carteles/Back to Black.jpg', 'Sam Taylor-Johnson', 2024, 1),
            ('Oppenheimer', 'La historia de J. Robert Oppenheimer y su papel en el desarrollo de la bomba atómica.', '180 min', 'Drama', '+16', '../imagenes/carteles/Oppenheimer.jpg', 'Christopher Nolan', 2023, 0),
            ('Barbie', 'Barbie emprende un viaje en el mundo real tras comenzar a cuestionar su existencia.', '114 min', 'Comedia', 'TP', '../imagenes/carteles/Barbie.jpg', 'Greta Gerwig', 2023, 0),
            ('Wonka', 'El joven Willy Wonka conoce a los Oompa Loompas y sueña con abrir su propia fábrica de chocolate.', '116 min', 'Aventura', 'TP', '../imagenes/carteles/Wonka.jpg', 'Paul King', 2023, 0),
            ('Los Juegos del Hambre Balada de Pájaros Cantores', 'Precuela de Los Juegos del Hambre que narra los orígenes del Presidente Snow.', '157 min', 'Acción', '+12', '../imagenes/carteles/Los Juegos del Hambre Balada de Pájaros Cantores.jpg', 'Francis Lawrence', 2023, 0),
            ('Napoleón', 'Relato épico sobre el ascenso al poder de Napoleón Bonaparte y su relación con Josefina.', '158 min', 'Histórica', '+16', '../imagenes/carteles/Napoleón.jpg', 'Ridley Scott', 2023, 0),
            ('Elemental', 'Una historia de amor entre elementos opuestos: fuego y agua.', '102 min', 'Animación', 'TP', '../imagenes/carteles/Elemental.jpg', 'Peter Sohn', 2023, 0),
            ('Super Mario Bros La Película', 'Mario y Luigi deben salvar el Reino Champiñón de Bowser.', '92 min', 'Animación', 'TP', '../imagenes/carteles/Super Mario Bros La Película.jpg', 'Aaron Horvath', 2023, 0),
            ('The Marvels', 'Carol Danvers, Kamala Khan y Monica Rambeau intercambian poderes y deben colaborar.', '105 min', 'Superhéroes', '+12', '../imagenes/carteles/The Marvels.jpg', 'Nia DaCosta', 2023, 0),
            ('Five Nights at Freddys', 'Un guardia nocturno descubre que las mascotas animatrónicas de una pizzería cobran vida.', '109 min', 'Terror', '+16', '../imagenes/carteles/Five Nights at Freddys.jpg', 'Emma Tammi', 2023, 0),
            ('El chico y la garza', 'Un joven entra a un mundo mágico buscando a su madre desaparecida.', '124 min', 'Animación', 'TP', '../imagenes/carteles/El chico y la garza.jpg', 'Hayao Miyazaki', 2023, 0),
            ('Trolls 3 Todos juntos', 'Los trolls deben salvar a un miembro perdido de su banda.', '91 min', 'Animación', 'TP', '../imagenes/carteles/Trolls 3 Todos juntos.jpg', 'Walt Dohrn', 2023, 0),
            ('Saw X', 'John Kramer viaja a México para someterse a un tratamiento experimental, pero descubre un fraude.', '118 min', 'Terror', '+18', '../imagenes/carteles/Saw X.jpg', 'Kevin Greutert', 2023, 0),
            ('The Batman', 'En Gotham City, el vigilante Batman descubre una red de corrupción mientras investiga una serie de asesinatos cometidos por el Acertijo, un asesino en serie enmascarado.', '176 min', 'Acción', 'No recomendada para menores de 16 años', '../imagenes/carteles/The Batman.jpg', 'Matt Reeves', 2022, 0);");

        $bdConexion->exec("INSERT INTO sesion (id_pelicula, id_sala, fecha_hora) VALUES
            (1, 1, '2025-06-11 15:30:00'),
            (2, 2, '2025-06-11 15:30:00'),
            (3, 3, '2025-06-11 15:30:00'),
            (4, 4, '2025-06-11 15:30:00'),
            (5, 5, '2025-06-11 15:30:00');");

        $passDefecto = password_hash("admin1234", PASSWORD_BCRYPT);

        $bdConexion->exec("INSERT INTO usuario (nombre, apellidos, email, contrasena, telefono, dni, fecha_nacimiento, tipo_usuario) VALUES
            ('Admin', 'Cine', 'admin@cine.com', '$passDefecto' , 600000000, '00000000A', '1990-01-01', 'admin');");

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