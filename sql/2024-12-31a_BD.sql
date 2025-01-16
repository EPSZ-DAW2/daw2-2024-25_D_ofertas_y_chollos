SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET AUTOCOMMIT=0;
START TRANSACTION;

-- Creación de la base de datos
DROP DATABASE IF EXISTS `daw_proyectod`;
CREATE DATABASE IF NOT EXISTS `daw_proyectod`
  CHARACTER SET 'utf8'
  COLLATE 'utf8_general_ci';
  
USE `daw_proyectod`;


-- Tabla de roles de usuarios
CREATE TABLE `roles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Crear la tabla de zonas con restricción de unicidad
CREATE TABLE `zonas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `clase` VARCHAR(50) NOT NULL,
    `nombre` VARCHAR(100) NOT NULL,
    `zona_padre_id` INT DEFAULT NULL,
    UNIQUE (`clase`, `nombre`),
    FOREIGN KEY (`zona_padre_id`) REFERENCES `zonas`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;



-- Tabla de usuarios
CREATE TABLE `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `nick` VARCHAR(50) NOT NULL UNIQUE,
    `nombre` VARCHAR(100),
    `apellidos` VARCHAR(100),
    `fecha_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `registro_confirmado` BOOLEAN DEFAULT FALSE,
    `fecha_ultimo_acceso` DATETIME DEFAULT NULL,
    `accesos_fallidos` INT DEFAULT 0,
    `bloqueado` BOOLEAN DEFAULT FALSE,
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` VARCHAR(255),
    `rol` INT, 
    FOREIGN KEY (`rol`) REFERENCES `roles`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de moderadores por zonas
CREATE TABLE `moderadores_zonas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `moderador_id` INT,
    `zona_id` INT, 
    FOREIGN KEY (`moderador_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de categorías
CREATE TABLE `categorias` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT,
    `revisado` BOOLEAN DEFAULT FALSE, 
    `categoria_padre_id` INT DEFAULT NULL, 
    FOREIGN KEY (`categoria_padre_id`) REFERENCES `categorias`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;



-- Tabla de etiquetas
CREATE TABLE `etiquetas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de relación entre usuarios y categorías
CREATE TABLE `usuarios_categorias` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `categoria_id` INT,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;


-- Tabla de relación entre usuarios y etiquetas
CREATE TABLE `usuarios_etiquetas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `etiqueta_id` INT,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;



-- Tabla de relación entre usuarios y zonas
CREATE TABLE `usuarios_zonas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `zona_id` INT,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;










-- Tabla de proveedores de los artículos
CREATE TABLE `proveedores` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `razon_social` VARCHAR(255) NOT NULL,
    `telefono_contacto` VARCHAR(20) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `zona_id` INT,
    `url_web` VARCHAR(255),
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;


-- Tabla de ofertas
CREATE TABLE `ofertas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(255) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `url_externa` VARCHAR(255),
    `fecha_inicio` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fecha_fin` DATETIME DEFAULT NULL,
    `precio_actual` DECIMAL(10, 2),
    `precio_original` DECIMAL(10, 2),
    `descuento` DECIMAL(5, 2),	
    `zona_id` INT,
    `categoria_id` INT,
    `proveedor_id` INT,
    `anuncio_destacado` BOOLEAN DEFAULT FALSE,
    `patrocinada` TINYINT DEFAULT 0,
    `destacada` TINYINT DEFAULT 0,
    `estado` VARCHAR(20) NOT NULL DEFAULT 'visible',	
    `denuncias` INT DEFAULT 0,
    `fecha_primer_denuncia` DATETIME DEFAULT NULL,
    `motivo_denuncia` TEXT,
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` TEXT,
    `cerrado_comentar` BOOLEAN DEFAULT FALSE,
    `usuario_creador_id` INT,
    `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `usuario_modificador_id` INT,
    `fecha_modificacion` DATETIME DEFAULT NULL,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_creador_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_modificador_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;


-- Tabla de imágenes de ofertas
CREATE TABLE `ofertas_imagenes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `oferta_id` INT,
    `url` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de enlaces de ofertas
CREATE TABLE `ofertas_enlaces` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `oferta_id` INT,
    `url` VARCHAR(255) NOT NULL,
    `texto` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;



-- Tabla de valoraciones de ofertas
CREATE TABLE `ofertas_valoraciones` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `oferta_id` INT,
    `usuario_id` INT,
    `valoracion` TINYINT CHECK (`valoracion` IN (1, -1)), 
    `fecha_valoracion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de relación entre ofertas y etiquetas
CREATE TABLE `ofertas_etiquetas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `oferta_id` INT,
    `etiqueta_id` INT,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;


-- Tabla de seguimientos de ofertas por usuarios
CREATE TABLE `seguimientos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `oferta_id` INT,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de comentarios
CREATE TABLE `comentarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `oferta_id` INT, 
    `texto` TEXT NOT NULL,
    `comentario_origen_id` INT DEFAULT NULL, 
    `cerrado` BOOLEAN DEFAULT FALSE,
    `denuncias` INT DEFAULT 0, 
    `fecha_primer_denuncia` DATETIME DEFAULT NULL,
    `motivo_denuncia` TEXT,
    `bloqueado` BOOLEAN DEFAULT FALSE, 
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` TEXT,
    `usuario_id` INT, 
    `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fecha_modificacion` DATETIME DEFAULT NULL, 
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`comentario_origen_id`) REFERENCES `comentarios`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de mensajes encriptados
CREATE TABLE `mensajes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `texto` TEXT NOT NULL,
    `usuario_origen_id` INT,
    `usuario_destino_id` INT,
    FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de incidencias
CREATE TABLE `incidencias` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `clase` VARCHAR(50),
    `texto` TEXT,
    `usuario_origen_id` INT,
    `usuario_destino_id` INT,
    `oferta_id` INT DEFAULT NULL,
    `comentario_id` INT DEFAULT NULL,
    `fecha_lectura` DATETIME DEFAULT NULL,
    `fecha_aceptado` DATETIME DEFAULT NULL,
    FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`comentario_id`) REFERENCES `comentarios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de logs 
CREATE TABLE `logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `nivel` VARCHAR(20), 
    `modulo` VARCHAR(50),
    `descripcion` VARCHAR(250)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;






