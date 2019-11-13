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


-- Dumping database structure for colaw
CREATE DATABASE IF NOT EXISTS `colaw` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `colaw`;

-- Dumping structure for table colaw.abogado
CREATE TABLE IF NOT EXISTS `abogado` (
  `id_abogado` int(11) NOT NULL AUTO_INCREMENT,
  `cuentaBanco` int(11) DEFAULT NULL,
  `costoBase` double DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `cedulaPro` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_abogado`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `abogado_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.abogado: ~0 rows (approximately)
/*!40000 ALTER TABLE `abogado` DISABLE KEYS */;
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
  PRIMARY KEY (`id_caso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.caso: ~0 rows (approximately)
/*!40000 ALTER TABLE `caso` DISABLE KEYS */;
/*!40000 ALTER TABLE `caso` ENABLE KEYS */;

-- Dumping structure for table colaw.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.categoria: ~0 rows (approximately)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Dumping structure for table colaw.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `metodoPago` varchar(25) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.cliente: ~0 rows (approximately)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Dumping structure for table colaw.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(20) NOT NULL,
  `valuePermission` int(11) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.rol: ~3 rows (approximately)
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
  `rol_id` int(11),
  PRIMARY KEY (`id_usuario`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table colaw.usuario: ~0 rows (approximately)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT IGNORE INTO `usuario` (`id_usuario`, `nombre`, `apellidoP`, `apellidoM`, `email`, `pass`, `fechaNac`, `rol_id`) VALUES
	(1, 'BRYAN', 'TLATELPA', 'SILVA', 'ejemplo@gmail.com', '123', '2000-01-01', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
