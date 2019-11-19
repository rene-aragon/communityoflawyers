-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


/*/'username' => 'colaw',
	'password' => 'co00ol4a44w',*/

-- Dumping database structure for colaw
CREATE DATABASE IF NOT EXISTS `colaw` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `colaw`;

-- Dumping structure for table colaw.abogado
CREATE TABLE IF NOT EXISTS `abogado` (
  `id_abogado` int(11) NOT NULL AUTO_INCREMENT,
  `cuentaBanco` int(11) NOT NULL,
  `costoBase` double NOT NULL,
  `descripcion` text DEFAULT NULL,
  `cedula` varchar(255) NOT NULL DEFAULT '',
  `curriculum` varchar(255) NOT NULL,
  `categoria1` int(11) NOT NULL DEFAULT 1,
  `categoria2` int(11) DEFAULT NULL,
  `categoria3` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id_abogado`),
  KEY `abogado_ibfk_1` (`usuario_id`),
  CONSTRAINT `abogado_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.abogado: ~1 rows (approximately)
/*!40000 ALTER TABLE `abogado` DISABLE KEYS */;
INSERT IGNORE INTO `abogado` (`id_abogado`, `cuentaBanco`, `costoBase`, `descripcion`, `cedula`, `curriculum`, `categoria1`, `categoria2`, `categoria3`, `usuario_id`) VALUES
	(1, 2147483647, 5000, NULL, 'public/uploads/Offline_Storage_Data_Sheet10.pdf', 'public/uploads/Offline_Storage_Data_Sheet11.pdf', 1, 2, 3, 2),
	(2, 2147483647, 5000, NULL, 'public/uploads/Offline_Storage_Data_Sheet10.pdf', 'public/uploads/Offline_Storage_Data_Sheet11.pdf', 2, 4, 8, 6),
	(3, 2147483647, 5000, NULL, 'public/uploads/Offline_Storage_Data_Sheet12.pdf', 'public/uploads/Offline_Storage_Data_Sheet13.pdf', 1, 2, 8, 13);
/*!40000 ALTER TABLE `abogado` ENABLE KEYS */;

-- Dumping structure for table colaw.caso
CREATE TABLE IF NOT EXISTS `caso` (
  `id_caso` int(11) NOT NULL AUTO_INCREMENT,
  `abogado_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL DEFAULT '',
  `descripcion` varchar(255) DEFAULT '',
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_caso`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.caso: ~11 rows (approximately)
/*!40000 ALTER TABLE `caso` DISABLE KEYS */;
INSERT IGNORE INTO `caso` (`id_caso`, `abogado_id`, `cliente_id`, `categoria_id`, `titulo`, `descripcion`, `estado`, `fecha`) VALUES
	(1, 6, 7, 1, 'caso civil', '', 2, '2019-11-18 16:58:41'),
	(2, 6, 7, 1, 'dinero dinero dinero', '', 2, '2019-11-18 17:00:29'),
	(3, 6, 7, 1, 'lorem ipsum', '', 3, '2019-11-19 10:34:32'),
	(4, 6, 7, 1, 'Lorem ipsum dolor sit amet consectetur .', '', 2, '2019-11-19 10:34:17'),
	(5, 6, 7, 1, 'Lorem ipsum potenti.', '', 1, '2019-11-19 10:34:09'),
	(6, 6, 7, 1, 'Lorem ipsum potenti.uuuu', '', 1, '2019-11-19 10:34:28'),
	(7, 6, 7, 1, 'Lorem ipsum potenti.www', '', 0, '2019-11-18 12:50:34'),
	(8, 6, 7, 1, 'Lorem ipsum potenti.xd', '', 0, '2019-11-18 12:50:39'),
	(9, 6, 7, 1, 'Lorem ipsum potenti.wewe', '', 0, '2019-11-18 12:50:39'),
	(10, 6, 7, 1, 'caso civil 2', '', 0, '2019-11-18 12:51:23'),
	(11, 6, 7, 1, 'caso civil 3', '', 0, '2019-11-18 12:51:27'),
	(12, 6, 7, 1, 'caso civil 4', '', 0, '2019-11-18 12:51:31');
/*!40000 ALTER TABLE `caso` ENABLE KEYS */;

-- Dumping structure for table colaw.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT '0',
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.categoria: ~8 rows (approximately)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT IGNORE INTO `categoria` (`categoria_id`, `nombre`) VALUES
	(1, 'CIVIL'),
	(2, 'LABORAL'),
	(3, 'FAMILIAR'),
	(4, 'MERCANTIL'),
	(5, 'PENAL'),
	(6, 'PROCESAL'),
	(7, 'INMOBILIARIO'),
	(8, '');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Dumping structure for table colaw.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `metodoPago` varchar(25) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `cliente_ibfk_1` (`usuario_id`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.cliente: ~3 rows (approximately)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT IGNORE INTO `cliente` (`id_cliente`, `metodoPago`, `usuario_id`) VALUES
	(1, 'credito', 7),
	(2, 'credito', 8),
	(3, 'transferencia', 9),
	(4, 'transferencia', 10),
	(5, 'transferencia', 11),
	(6, 'transferencia', 12);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Dumping structure for table colaw.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(20) NOT NULL,
  `valuePermission` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.rol: ~4 rows (approximately)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT IGNORE INTO `rol` (`id_rol`, `nombreRol`, `valuePermission`) VALUES
	(1, 'ADMINISTRADOR', 0),
	(2, 'ABOGADO', 1),
	(3, 'CLIENTE', 2);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Dumping structure for table colaw.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellidoP` varchar(20) NOT NULL,
  `apellidoM` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `fechaNac` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `imagen` varchar(255) NOT NULL DEFAULT '1',
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_ibfk_1` (`rol_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.usuario: ~6 rows (approximately)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT IGNORE INTO `usuario` (`id_usuario`, `nombre`, `apellidoP`, `apellidoM`, `email`, `pass`, `fechaNac`, `estado`, `imagen`, `rol_id`) VALUES
	(1, 'BRYAN', 'TLATELPA', 'SILVA', 'ejemplo@gmail.com', '123456', '2000-01-01', 1, '1', 1),
	(2, 'Rodrigo', 'Chantes', 'Palacios', 'rodrigo.chantes@hotmail.com', '123456', '1997-06-05', 0, 'public/uploads/Aerobics4.png', 2),
	(6, 'Rodrigo', 'Chantes', 'Palacios', 'rodrigo.chantes@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/Aerobics4.png', 2),
	(7, 'Luis', 'Rey', 'Salas', 'luis.rey@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/Aerobics4.png', 3),
	(8, 'Sergio', 'Martinez', 'Cornelio', 'sergio.martinez@gmail.com', '123456', '1997-06-05', 0, 'public/uploads/Aerobics4.png', 3),
	(9, 'Luis', 'Rey', 'Salas', 'luis.rey.salas@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/taylor_swift_450.jpg', 1),
	(10, 'Rodrigo', 'Palacios', 'Chantes', 'rodrigo.palacios@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/Taylor_Swift.jpg', 1),
	(11, 'Rodrigo', 'Chantes', 'Perez', 'rodrigo.chantes.perez@hotmail.com', '123456', '1997-06-05', 1, 'public/uploads/taylor_swift_4501.jpg', 3),
	(12, 'Luis', 'Perez', 'Rojas', 'luis.perez@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/taylor_swift_4502.jpg', 3),
	(13, 'Rodrigo Francisco', 'Chantes', 'Perez', 'rodrigofcp@gmail.com', '123456', '1997-06-05', 1, 'public/uploads/taylor_swift_4503.jpg', 2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
