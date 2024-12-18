-- Creación de la base de datos
DROP DATABASE IF EXISTS `daw_proyectoD`;
CREATE DATABASE IF NOT EXISTS `daw_proyectoD`
  CHARACTER SET 'utf8'
  COLLATE 'utf8_general_ci';
  
USE `daw_proyectoD`;

-- Tabla de roles de usuarios
CREATE TABLE `roles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de zonas para clasificar usuarios y anuncios por ubicación y cercanía
CREATE TABLE `zonas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `clase` VARCHAR(50) NOT NULL,
    `nombre` VARCHAR(100) NOT NULL,
    `zona_padre_id` INT DEFAULT NULL, --para hacer subzonas si se quiere tipo provincias y comunidades
    FOREIGN KEY (`zona_padre_id`) REFERENCES `zonas`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de usuarios
CREATE TABLE `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `nick` VARCHAR(50) NOT NULL UNIQUE,
    `nombre` VARCHAR(100),
    `apellidos` VARCHAR(100),
    `fecha_nacimiento` DATE,
    `direccion` VARCHAR(255),
    `zona_id` INT,
    `fecha_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `registro_confirmado` BOOLEAN DEFAULT FALSE,
    `fecha_ultimo_acceso` DATETIME DEFAULT NULL,
    `accesos_fallidos` INT DEFAULT 0,
    `bloqueado` BOOLEAN DEFAULT FALSE,
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` VARCHAR(255),
    `tipo_usuario` INT,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`),
    FOREIGN KEY (`tipo_usuario`) REFERENCES `roles`(`id`)
);ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de moderadores por zonas
CREATE TABLE `moderadores_zonas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `moderador_id` INT,
    `zona_id` INT, --zona asignada al moderador
    FOREIGN KEY (`moderador_id`) REFERENCES `usuarios`(`id`),
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de categorías
CREATE TABLE `categorias` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT,
    `icono` VARCHAR(255), --para poner un icono en la web y asi se guarda aqui la ruta
    `categoria_padre_id` INT DEFAULT NULL, --para hacer subcategorías si se quiere
    FOREIGN KEY (`categoria_padre_id`) REFERENCES `categorias`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;


/* por si se quiere hacer etiquetas para los anuncios
-- Tabla de etiquetas
CREATE TABLE `etiquetas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

*/

-- Tabla de proveedores de los artículos
CREATE TABLE `proveedores` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nif_cif` VARCHAR(20) NOT NULL UNIQUE,
    `nombre` VARCHAR(100),
    `apellidos` VARCHAR(100),
    `razon_social` VARCHAR(255),
    `telefono_contacto` VARCHAR(20),
    `direccion` VARCHAR(255),
    `zona_id` INT,
    `url_web` VARCHAR(255),
    `usuario_id` INT,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`),
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de anuncios
CREATE TABLE `anuncios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(255) NOT NULL,
    `descripcion` TEXT NOT NULL,
    `tienda` VARCHAR(255),
    `url_externa` VARCHAR(255),
    `fecha_inicio` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fecha_fin` DATETIME DEFAULT NULL,
    `precio` DECIMAL(10, 2),
    `precio_original` DECIMAL(10, 2),
    `zona_id` INT,
    `categoria_id` INT,
    `proveedor_id` INT,
    `prioridad` INT DEFAULT 0,
    `visible` BOOLEAN DEFAULT TRUE,
    `terminada` BOOLEAN DEFAULT FALSE,
    `fecha_terminacion` DATETIME DEFAULT NULL,
    `denuncias` INT DEFAULT 0,
    `fecha_primer_denuncia` DATETIME DEFAULT NULL,
    `motivo_denuncia` TEXT,
    `bloqueado` BOOLEAN DEFAULT FALSE,
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` TEXT,
    `cerrado_comentar` BOOLEAN DEFAULT FALSE,
    `usuario_creador_id` INT,
    `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `usuario_modificador_id` INT,
    `fecha_modificacion` DATETIME DEFAULT NULL,
    FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`id`),
    FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`),
    FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id`),
    FOREIGN KEY (`usuario_creador_id`) REFERENCES `usuarios`(`id`),
    FOREIGN KEY (`usuario_modificador_id`) REFERENCES `usuarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;



/* por si se quiere hacer etiquetas para los anuncios
-- Tabla de relación entre anuncios y etiquetas
CREATE TABLE `anuncios_etiquetas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `anuncio_id` INT,
    `etiqueta_id` INT,
    FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios`(`id`),
    FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;
*/

-- Tabla de comentarios
CREATE TABLE `comentarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `anuncio_id` INT, --anuncio al que pertenece
    `texto` TEXT NOT NULL,
    `comentario_origen_id` INT DEFAULT NULL, --comentario al que responde si es que respondiese
    `cerrado` BOOLEAN DEFAULT FALSE,
    `denuncias` INT DEFAULT 0, 
    `fecha_primer_denuncia` DATETIME DEFAULT NULL,
    `motivo_denuncia` TEXT,
    `bloqueado` BOOLEAN DEFAULT FALSE, --si está bloqueado no se muestra
    `fecha_bloqueo` DATETIME DEFAULT NULL,
    `motivo_bloqueo` TEXT,
    `usuario_id` INT, --usuario que lo ha escrito
    `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fecha_modificacion` DATETIME DEFAULT NULL, --fecha de la última modificación si la hubiera
    FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios`(`id`),
    FOREIGN KEY (`comentario_origen_id`) REFERENCES `comentarios`(`id`),
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de mensajes encriptados
CREATE TABLE `mensajes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `texto` TEXT NOT NULL,
    `usuario_origen_id` INT,
    `usuario_destino_id` INT,
    FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios`(`id`),
    FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;

-- Tabla de incidencias
CREATE TABLE `incidencias` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `clase` VARCHAR(50),
    `texto` TEXT,
    `usuario_origen_id` INT,
    `usuario_destino_id` INT,
    `anuncio_id` INT DEFAULT NULL,
    `comentario_id` INT DEFAULT NULL,
    `fecha_lectura` DATETIME DEFAULT NULL,
    `fecha_aceptado` DATETIME DEFAULT NULL,
    FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios`(`id`),
    FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios`(`id`),
    FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios`(`id`),
    FOREIGN KEY (`comentario_id`) REFERENCES `comentarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;




-- Tabla de logs de accesos y acciones por si queremos el histórico
CREATE TABLE `logs_accesos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT,
    `fecha_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `ip_origen` VARCHAR(45),
    `accion` VARCHAR(50),
    `resultado` VARCHAR(50),
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;