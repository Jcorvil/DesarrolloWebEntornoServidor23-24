-- Base de datos MARATOON
-- Módulo: Base de Datos
-- Curso: 2º DAW
-- Autor: Juan Carlos Moreno
-- Descripción: Posibilita la ejecución de los ejemplos incluidos en los apuntes.
--
DROP DATABASE IF EXISTS maratoon;
CREATE DATABASE maratoon;
USE maratoon;
--
-- tabla categorías
--
DROP TABLE IF EXISTS Categorias;
CREATE TABLE IF NOT EXISTS Categorias(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombrecorto CHAR(3) UNIQUE,
 nombre VARCHAR(20),
 descripcion VARCHAR(30)
);
--
-- Tabla Carreras
--
DROP TABLE IF EXISTS Carreras;
CREATE TABLE IF NOT EXISTS Carreras(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(30),
 ciudad VARCHAR(20),
 distancia INT UNSIGNED,
 mesCelebracion TINYINT UNSIGNED
);
--
-- Tabla de Club
--
DROP TABLE IF EXISTS Clubs;
CREATE TABLE IF NOT EXISTS Clubs(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombreCorto CHAR(3) UNIQUE,
 nombre VARCHAR(30),
 ciudad VARCHAR(20),
 fecFundacion DATE,
 numSocios INT UNSIGNED
);
--
-- Tabla Corredores
--
DROP TABLE IF EXISTS Corredores;
CREATE TABLE IF NOT EXISTS Corredores(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(20),
 apellidos VARCHAR(45),
 ciudad VARCHAR(30),
 fechaNacimiento DATE NOT NULL,
 sexo ENUM(' ', 'H', 'M') DEFAULT ' ',
 email varchar(45) unique,
 dni char(9) unique,
 edad INT(2) UNSIGNED,
 id_categoria INT UNSIGNED,
 id_club INT UNSIGNED,
 FOREIGN KEY (id_categoria) REFERENCES Categorias (id)
 ON DELETE RESTRICT ON UPDATE CASCADE,
 FOREIGN KEY (id_club) REFERENCES Clubs (id)
 ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Continuación script anterior
--
-- Tabla Registros
--
-- Registro de los tiempos invertidos por cada corredor en cada carrera
-- en la que participa
DROP TABLE IF EXISTS Registros;
CREATE TABLE Registros(
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 id_carrera INT UNSIGNED,
 id_corredor INT UNSIGNED,
 salida DATETIME,
 llegada DATETIME,
 tiempoInvertido TIME,
 FOREIGN KEY (id_carrera) REFERENCES Carreras (id)
 ON DELETE RESTRICT ON UPDATE CASCADE,
 FOREIGN KEY (id_corredor) REFERENCES Corredores (id)
 ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabla Categoria
INSERT INTO Categorias VALUES
(1, 'INF', 'Infantil', 'Menores de 12 años'),
(2, 'JUN', 'Junior', 'Menores de 15 años'),
(3, 'JUV', 'Juvenil', 'Menores de 18 años'),
(4, 'SNA', 'Senior A', 'Menores de 30 años'),
(5, 'SNB', 'Senior B', 'Menores de 40 años'),
(6, 'VTA', 'Veteranos A', 'Menores de 50 años'),
(7, 'VTB', 'Veteranos B', 'Menores de 60 años'),
(8, 'VTC', 'Veteranos C', 'A partir de 60 años');
--
-- Tabla Carrera
INSERT INTO Carreras VALUES
(1, 'Nutrias Pantaneras', 'Ubrique', 11000, 10),
(2, 'Media Martoon Sevilla', 'Sevilla', 22000, 6),
(3, 'Media Martoon Jerez', 'Jerez', 22000, 5),
(4, 'Salida Sanluqueña', 'Sanlucar de Bda.', 11500, 3);
--
-- Tabla Carrera
INSERT INTO Clubs VALUES
(1, 'NUT', 'Nutrias Pantaneras', 'Ubrique', '1980-4-11', 150),
(2, 'CAV', 'Club Atletismo Villamartín', 'Villamartín', '1985-4-11', 200),
(3, 'ACG', 'Atletismo Campo de Gibraltar', 'La Línea', '1987-4-11', 150),
(4, 'ADJ', 'Asociación Deportiva de Arcos', 'Arcos de la Fra.', '1970-4-11', 300),
(5, 'CAF', 'Club Atletismo Fronter', 'Jerez de la Fra.', '1975-4-11', 220);

--
-- Tabla Corredor
INSERT INTO Corredores VALUES
(1,'Juan','García Pérez','Ubrique','1965-7-31', 'H', 'juan@gmail.com', '11111111A', NULL, NULL, 1),
(2,'Juan José','Pérez Morales','Ubrique','1945-8-30', 'H', 'juanjose@gmail.com', '21111111A', NULL, NULL, 1),
(3,'Eva','Rubiales Alva','Ubrique','1980-8-25', 'M', 'eva@gmail.com', '31111111A', NULL, NULL, 1),
(4,'Josefa','Rios Pérez','Villamartín','1990-10-15', 'M', 'josefa@gmail.com', '41111111A', NULL, NULL, 2),
(5,'Pedro','Ortega Ríos','Villamartín','1994-5-14', 'H', 'pedro@gmail.com', '51111111A', NULL, NULL, 2),
(6,'Francisco','Morales Almeida','Villamartín','1970-2-1', 'H', 'francisco@gmail.com', '61111111A', NULL, NULL, 2),
(7,'Macarena','Fernández Pérez','Villamartín','1980-5-3', 'M', 'macarena@gmail.com', '71111111A', NULL, NULL, 2),
(8,'Jesús','Romero Reguera','Villamartín','1970-6-5', 'H', 'jesus@gmail.com', '81111111A', NULL, NULL, 2),
(9,'Pedro','García Ramírez','Ubrique','1967-7-31', 'H', 'pedrito@gmail.com', '91111111A', NULL, NULL, 1),
(10,'María','Pérez Moreno','Ubrique','1975-8-30', 'M', 'maria@gmail.com', '10111111A', NULL, NULL, 1),
(11,'Almudena','Romero Alva','Arcos','1986-8-25', 'M', 'almudena@gmail.com', '11111111B', NULL, NULL, 4),
(12,'Francisco','Pérez Amor','Arcos','1992-10-15', 'H', 'currito@gmail.com', '12111111A', NULL, NULL, 4),
(13,'Juan','Rodríguez Ríos','Ubrique','1978-5-14', 'H', 'juanro@gmail.com', '13111111A', NULL, NULL, 1),
(14,'Cristina','García Almeida','Villamartín','1978-2-1', 'M', 'cristina@gmail.com', '14111111A', NULL, NULL, 2),
(15,'Romira','Jiménez Pérez','Arcos','1984-5-3', 'M', 'romira@gmail.com', '15111111A', NULL, NULL, 4),
(16,'José','Rincón Pérez','Villamartín','1960-6-5', 'H', 'joselito@gmail.com', '16111111A', NULL, NULL, 2);
--
-- Tabla Registro
INSERT INTO registros VALUES
(1, 1, 1,'2012-4-11 10:00:00.00000','2012-4-11 10:45:10.00000', NULL),
(2, 1, 2,'2012-4-11 10:00:00.00000','2012-4-11 10:35:10.00000', NULL),
(3, 1, 3,'2012-4-11 10:00:00.00000','2012-4-11 10:37:10.00148', NULL),
(4, 1, 4,'2012-4-11 10:00:00.00000','2012-4-11 10:36:20.00000', NULL),
(5, 1, 5,'2012-4-11 10:00:00.00000','2012-4-11 10:35:40.00000', NULL),
(6, 1, 6,'2012-4-11 10:00:00.00000','2012-4-11 10:40:01.00000', NULL),
(7, 1, 7,'2012-4-11 10:00:00.00000','2012-4-11 10:30:30.00908', NULL),
(8, 1, 8,'2012-4-11 10:00:00.00000','2012-4-11 10:38:10.00000', NULL),
(9, 1, 9,'2012-4-11 10:00:00.00000','2012-4-11 10:48:10.00000', NULL),
(10, 1, 10,'2012-4-11 10:00:00.00000','2012-4-11 10:39:10.00000', NULL),
(11, 1, 11,'2012-4-11 10:00:00.00000','2012-4-11 10:55:10.00148', NULL),
(12, 1, 12,'2012-4-11 10:00:00.00000','2012-4-11 10:50:20.00000', NULL),
(13, 1, 13,'2012-4-11 10:00:00.00000','2012-4-11 10:58:40.00000', NULL),
(14, 1, 14,'2012-4-11 10:00:00.00000','2012-4-11 11::01.00000', NULL),
(15, 1, 15,'2012-4-11 10:00:00.00000','2012-4-11 11:10:30.00908', NULL),
(16, 1, 16,'2012-4-11 10:00:00.00000','2012-4-11 11:09:10.00000', NULL);

-- Actualiza el campo Edad a partir de la Fecha de Nacimiento del corredor
--
UPDATE Corredores SET Edad = TIMESTAMPDIFF(YEAR,FechaNacimiento,NOW());
--
-- Actualizar la columna CodCategoría de la tabla corredor, teniendo en
-- cuenta la Edad y el cuadrante de la tabla categorías
--
UPDATE Corredores SET id_categoria = 1 WHERE Edad<12;
UPDATE Corredores SET id_categoria = 2 WHERE Edad BETWEEN 12 AND 14;
UPDATE Corredores SET id_categoria = 3 WHERE Edad BETWEEN 15 AND 17;
UPDATE Corredores SET id_categoria = 4 WHERE Edad BETWEEN 18 AND 29;
UPDATE Corredores SET id_categoria = 5 WHERE Edad BETWEEN 30 AND 39;
UPDATE Corredores SET id_categoria = 6 WHERE Edad BETWEEN 40 AND 49;
UPDATE Corredores SET id_categoria = 7 WHERE Edad BETWEEN 50 AND 60;
UPDATE Corredores SET id_categoria = 8 WHERE Edad>=60;
--
-- Actualizar la columna Tiempoinvertido de la tabla Registros,
-- a partir de las columnas Salida y Llegada.
--
UPDATE registros SET TiempoInvertido = TIMEDIFF(Llegada,Salida);