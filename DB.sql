CREATE DATABASE IF NOT EXISTS `colaw` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `colaw`;

CREATE TABLE IF NOT EXISTS  rol(
    id_rol INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreRol VARCHAR(20) NOT NULL,
    valuePermission INT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  usuario(
    id_usuario INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    apellidoP VARCHAR(20) NOT NULL,
    apellidoM VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    fechaNac DATE NOT NULL,
    rol_id INT(11),
    FOREIGN KEY (rol_id)
    REFERENCES rol(id_rol)
    ON DELETE SET NULL
	ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO rol(
    nombreRol,
    valuePermission
)
VALUES(
    "ADMINISTRADOR",
    0
)


INSERT INTO usuario(
    nombre,
    apellidoP,
    apellidoM,
    email,
    pass,
    fechaNac,
    rol_id
)
VALUES(
    "BRYAN",
    "TLATELPA",
    "SILVA",
    "ejemplo@gmail.com",
    "123",
    "2000-01-01",
    1
)