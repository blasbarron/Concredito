/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE IF NOT EXISTS `proyecto_blas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `proyecto_blas`;

CREATE TABLE IF NOT EXISTS `historial` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `comentarios` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_historial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id_historial`, `id_usuario`, `id_solicitud`, `comentarios`) VALUES
	(1, 11, 24, 'rechazada'),
	(2, 11, 25, 'aceptada'),
	(3, 11, 26, 'aceptada'),
	(4, 11, 26, 'aceptada'),
	(5, 11, 28, 'aceptada');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `interes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `interes` DISABLE KEYS */;
INSERT INTO `interes` (`id`, `valor`) VALUES
	(1, 0.05),
	(2, 0.07),
	(3, 0.12);
/*!40000 ALTER TABLE `interes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `notificacion` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_notificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
INSERT INTO `notificacion` (`id_notificacion`, `id_cliente`, `status`) VALUES
	(7, 11, 0),
	(8, 11, 0),
	(9, 11, 0),
	(10, 11, 0),
	(11, 11, 0);
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `web_solicitudes` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(10) NOT NULL,
  `plazo` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `id_status` int(2) NOT NULL,
  `comentarios` varchar(50) DEFAULT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `web_solicitudes` DISABLE KEYS */;
INSERT INTO `web_solicitudes` (`id_solicitud`, `id_usuario`, `plazo`, `monto`, `id_status`, `comentarios`, `fecha_solicitud`, `fecha`) VALUES
	(24, '11', 1, 315, 1, 'rechazada', '2018-11-15 13:27:07', '2018-11-15 13:28:53'),
	(25, '11', 1, 315, 1, 'aceptada', '2018-11-15 13:30:24', '2018-11-15 15:11:43'),
	(26, '11', 1, 10500, 1, 'aceptada', '2018-11-15 15:14:37', '2018-11-15 15:33:07'),
	(28, '11', 1, 10500, 1, 'aceptada', '2018-11-15 15:34:36', '2018-11-15 15:35:02');
/*!40000 ALTER TABLE `web_solicitudes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `web_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `jerarquia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `web_usuarios` DISABLE KEYS */;
INSERT INTO `web_usuarios` (`id_usuario`, `username`, `jerarquia`) VALUES
	(1, 'Blas Arturo Barron Montijo', 1),
	(2, 'Arturo Barron ', 1),
	(4, 'Delia Montijo', 1),
	(5, 'Delia Montijo', 1),
	(6, 'Montijo', 1),
	(7, 'carlos', 1),
	(8, 'Juan Antonio', 1),
	(9, 'blas', 1),
	(10, 'arturi', 1),
	(11, 'delia', 1),
	(12, 'Manuel', 1);
/*!40000 ALTER TABLE `web_usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
