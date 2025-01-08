SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET AUTOCOMMIT=0;
START TRANSACTION;

USE `daw_proyectod`;

-- Tabla de anuncios de ofertas
CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `oferta_id` int(11) NOT NULL,
  FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

