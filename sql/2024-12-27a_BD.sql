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


-- INSERCIÓN DE DATOS INICIALES

-- Roles de usuarios
INSERT INTO `roles` (`nombre`) VALUES ('Superadministrador');
INSERT INTO `roles` (`nombre`) VALUES ('Administrador');
INSERT INTO `roles` (`nombre`) VALUES ('Moderador');
INSERT INTO `roles` (`nombre`) VALUES ('Proveedor');
INSERT INTO `roles` (`nombre`) VALUES ('Usuario');

-- Zonas
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Andalucía');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Almería', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Cádiz', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Córdoba', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Granada', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Huelva', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Jaén', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Málaga', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Sevilla', 1);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Aragón');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Huesca', 9);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Teruel', 9);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Zaragoza', 9);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Asturias');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Asturias', 12);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Islas Baleares');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Islas Baleares', 14);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Canarias');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Las Palmas', 16);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Santa Cruz de Tenerife', 16);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Cantabria');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Cantabria', 18);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Castilla y León');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Ávila', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Burgos', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'León', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Palencia', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Salamanca', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Segovia', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Soria', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Valladolid', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Zamora', 20);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Castilla-La Mancha');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Albacete', 29);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Ciudad Real', 29);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Cuenca', 29);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Guadalajara', 29);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Toledo', 29);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Cataluña');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Barcelona', 34);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Girona', 34);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Lleida', 34);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Tarragona', 34);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Extremadura');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Badajoz', 39);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Cáceres', 39);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Galicia');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'A Coruña', 42);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Lugo', 42);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Ourense', 42);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Pontevedra', 42);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Madrid');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Madrid', 46);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Murcia');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Murcia', 48);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Navarra');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Navarra', 50);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'País Vasco');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Álava', 52);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Gipuzkoa', 52);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Bizkaia', 52);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'La Rioja');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'La Rioja', 56);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Comunidad Valenciana');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Alicante', 58);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Castellón', 58);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Valencia', 58);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Ceuta');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Ceuta', 61);
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Comunidad', 'Melilla');
INSERT INTO `zonas` (`clase`, `nombre`) VALUES ('Provincia', 'Melilla', 63);


-- Categorías
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Electrónica','Todo tipo de aparatos electrónicos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Moda','Ropa y complementos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Hogar','Artículos para el hogar');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Deporte','Artículos deportivos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Motor','Vehículos y accesorios');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Inmobiliaria','Viviendas y locales');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Viajes','Paquetes turísticos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Cultura y ocio','Espectáculos y eventos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Salud y belleza','Productos y servicios de salud y belleza');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Juguetes','Todo tipo de juguetes y juegos');
INSERT INTO `categorias` (`nombre`,`descripcion`) VALUES ('Alimentación','Productos alimenticios');
INSERT INTO `categorias` (`nombre`) VALUES ('Otros');
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Móviles','Todo sobre teléfonos móviles, desde smartphones hasta móviles para personas mayores',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ordenadores','Ordenadores de sobremesa, portátiles, etc.',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Televisores','Televisores de todo tipo',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Cámaras','Cámaras de fotos y vídeo',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Consolas','Consolas de videojuegos',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Tablets','Tablets y e-books',1);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa de hombre','Ropa y complementos para hombre',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa de mujer','Ropa y complementos para mujer',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa de niño','Ropa y complementos para niños',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa de niña','Ropa y complementos para niñas',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa de bebé','Ropa y complementos para bebés',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Zapatos de hombre','Zapatos para hombre',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Zapatos de mujer','Zapatos para mujer',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Zapatos de niño','Zapatos para niños',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Zapatos de niña','Zapatos para niñas',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Zapatos de bebé','Zapatos para bebés',2);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Muebles','Muebles y decoración para el hogar',3);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Electrodomésticos','Electrodomésticos para el hogar',3);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Menaje','Menaje de cocina y hogar',3);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Textil','Textil para el hogar',3);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Ropa deportiva','Ropa y complementos deportivos',4);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Calzado deportivo','Calzado deportivo',4);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Material deportivo','Material deportivo',4);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Coches','Coches nuevos y de segunda mano',5);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Motos','Motos nuevas y de segunda mano',5);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Bicicletas','Bicicletas nuevas y de segunda mano',5);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Recambios','Recambios y accesorios para vehículos',5);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Pisos','Pisos en venta y alquiler',6);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Locales','Locales en venta y alquiler',6);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Terrenos','Terrenos en venta y alquiler',6);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Casas rurales','Casas rurales en venta y alquiler',6);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Hoteles','Hoteles en venta y alquiler',6);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Paquetes turísticos','Paquetes turísticos',7);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Cruceros','Cruceros',7);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Vuelos','Vuelos',7);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Espectáculos','Espectáculos y eventos',8);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Cine','Cine',8);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Teatro','Teatro',8);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Conciertos','Conciertos',8);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Spa','Spa y tratamientos de belleza',9);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Gimnasio','Gimnasio y entrenamiento personal',9);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Peluquería','Peluquería y estética',9);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Juguetes de madera','Juguetes para infantes de madera',10);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Juguetes electrónicos','Juguetes para infantes con componentes electrónicos',10);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Juguetes de construcción','Juguetes para infantes de construcción',10);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Juguetes de peluche','Juguetes para infantes de peluche',10);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Frutas','Frutas frescas y de temporada',11);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Verduras','Verduras frescas y de temporada',11);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Carne','Carne fresca y de calidad',11);
INSERT INTO `categorias` (`nombre`,`descripcion`,`categoria_padre_id`) VALUES ('Pescado','Pescado fresco y de calidad',11);

-- Usuarios

-- Superadministrador
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('super@mail.com', 'passsuper', 'superadmin', 'Paco', 'Giménez', 1); --1

-- Administradores
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('admin1@mail.com', 'passadmin1', 'admin1', 'Juan', 'Martínez', 2);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('admin2@mail.com', 'passadmin2', 'admin2', 'Ana', 'García', 2);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('admin3@mail.com', 'passadmin3', 'admin3', 'Luis', 'Sánchez', 2);

-- Moderadores
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modand1@mail.com', 'passmodand1', 'modand1', 'María', 'López', 3); --5
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modand2@mail.com', 'passmodand2', 'modand2', 'Pedro', 'Fernández', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modand3@mail.com', 'passmodand3', 'modand3', 'Carmen', 'Gómez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modarg1@mail.com', 'passmodarg1', 'modarg1', 'Antonio', 'Rodríguez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modast1@mail.com', 'passmodast1', 'modast1', 'Isabel', 'Pérez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modbal1@mail.com', 'passmodbal1', 'modbal1', 'Manuel', 'Hernández', 3); --10
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcan1@mail.com', 'passmodcan1', 'modcan1', 'Rosa', 'Jiménez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcant1@mail.com', 'passmodcant1', 'modcant1', 'Miguel', 'Martínez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcyl1@mail.com', 'passmodcyl1', 'modcyl1', 'Francisco', 'Torres', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcyl2@mail.com', 'passmodcyl2', 'modcyl2', 'Laura', 'Sanz', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcyl3@mail.com', 'passmodcyl3', 'modcyl3', 'Javier', 'Ibáñez', 3); --15
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modclm1@mail.com', 'passmodclm1', 'modclm1', 'Marina', 'Garrido', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modclm2@mail.com', 'passmodclm2', 'modclm2', 'Carlos', 'Gutiérrez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcat1@mail.com', 'passmodcat1', 'modcat1', 'Sara', 'Martín', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modcat2@mail.com', 'passmodcat2', 'modcat2', 'David', 'Vega', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modext1@mail.com', 'passmodext1', 'modext1', 'Elena', 'Ortega', 3); --20
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modgal1@mail.com', 'passmodgal1', 'modgal1', 'Jorge', 'García', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modgal2@mail.com', 'passmodgal2', 'modgal2', 'Marta', 'Gómez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modmad1@mail.com', 'passmodmad1', 'modmad1', 'Víctor', 'Sánchez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modmur1@mail.com', 'passmodmur1', 'modmur1', 'Patricia', 'Martínez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modnav1@mail.com', 'passmodnav1', 'modnav1', 'Roberto', 'Fernández', 3); --25
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modpv1@mail.com', 'passmodpv1', 'modpv1', 'Eva', 'Gómez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modpv2@mail.com', 'passmodpv2', 'modpv2', 'Adrián', 'Sanz', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modrio1@mail.com', 'passmodrio1', 'modrio1', 'Cristina', 'Torres', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modval1@mail.com', 'passmodval1', 'modval1', 'Sergio', 'Ibáñez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modval2@mail.com', 'passmodval2', 'modval2', 'Nuria', 'Garrido', 3); --30
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modceu1@mail.com', 'passmodceu1', 'modceu1', 'Óscar', 'Gutiérrez', 3);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('modmel1@mail.com', 'passmodmel1', 'modmel1', 'Raquel', 'Martín', 3);

-- Proveedores
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov1@mail.com', 'passprov1', 'prov1', 'José', 'Martínez', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov2@mail.com', 'passprov2', 'prov2', 'María', 'López', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov3@mail.com', 'passprov3', 'prov3', 'Carlos', 'García', 4); --35
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov4@mail.com', 'passprov4', 'prov4', 'Ana', 'Sánchez', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov5@mail.com', 'passprov5', 'prov5', 'Luis', 'Martín', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov6@mail.com', 'passprov6', 'prov6', 'Elena', 'Pérez', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov7@mail.com', 'passprov7', 'prov7', 'Javier', 'Gómez', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov8@mail.com', 'passprov8', 'prov8', 'Laura', 'Hernández', 4); --40
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov9@mail.com', 'passprov9', 'prov9', 'David', 'Jiménez', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov10@mail.com', 'passprov10', 'prov10', 'Patricia', 'Ruiz', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov11@mail.com', 'passprov11', 'prov11', 'Miguel', 'Fernández', 4);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('prov12@mail.com', 'passprov12', 'prov12', 'Sara', 'Torres', 4);

-- Usuarios
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu1@mail.com', 'passusu1', 'usu1', 'Antonio', 'Martínez', 5); --45
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu2@mail.com', 'passusu2', 'usu2', 'María', 'López', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu3@mail.com', 'passusu3', 'usu3', 'Carlos', 'García', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu4@mail.com', 'passusu4', 'usu4', 'Ana', 'Sánchez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu5@mail.com', 'passusu5', 'usu5', 'Luis', 'Martín', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu6@mail.com', 'passusu6', 'usu6', 'Elena', 'Pérez', 5); --50
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu7@mail.com', 'passusu7', 'usu7', 'Javier', 'Gómez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu8@mail.com', 'passusu8', 'usu8', 'Laura', 'Hernández', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu9@mail.com', 'passusu9', 'usu9', 'David', 'Jiménez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu10@mail.com', 'passusu10', 'usu10', 'Patricia', 'Ruiz', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu11@mail.com', 'passusu11', 'usu11', 'Miguel', 'Fernández', 5); --55
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu12@mail.com', 'passusu12', 'usu12', 'Sara', 'Torres', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu13@mail.com', 'passusu13', 'usu13', 'Antonio', 'García', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu14@mail.com', 'passusu14', 'usu14', 'María', 'Martínez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu15@mail.com', 'passusu15', 'usu15', 'Carlos', 'López', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu16@mail.com', 'passusu16', 'usu16', 'Ana', 'García', 5); --60
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu17@mail.com', 'passusu17', 'usu17', 'Luis', 'Sánchez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu18@mail.com', 'passusu18', 'usu18', 'Elena', 'Martín', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu19@mail.com', 'passusu19', 'usu19', 'Javier', 'Pérez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu20@mail.com', 'passusu20', 'usu20', 'Laura', 'Gómez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu21@mail.com', 'passusu21', 'usu21', 'David', 'Hernández', 5); --65
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu22@mail.com', 'passusu22', 'usu22', 'Patricia', 'Jiménez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu23@mail.com', 'passusu23', 'usu23', 'Miguel', 'Ruiz', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu24@mail.com', 'passusu24', 'usu24', 'Sara', 'Fernández', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `tipo_usuario`) VALUES ('usu25@mail.com', 'passusu25', 'usu25', 'Antonio', 'Torres', 5); --69


-- Moderadores de zonas
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (5, 1); -- modand1 en Andalucía
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (6, 1); -- modand2 en Andalucía
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (7, 1); -- modand3 en Andalucía
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (8, 9); -- modarg1 en Aragón
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (9, 12); -- modast1 en Asturias
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (10, 14); -- modbal1 en Islas Baleares
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (11, 16); -- modcan1 en Canarias
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (12, 18); -- modcant1 en Cantabria
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (13, 20); -- modcyl1 en Castilla y León
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (14, 20); -- modcyl2 en Castilla y León
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (15, 20); -- modcyl3 en Castilla y León
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (16, 29); -- modclm1 en Castilla-La Mancha
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (17, 29); -- modclm2 en Castilla-La Mancha
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (18, 34); -- modcat1 en Cataluña
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (19, 34); -- modcat2 en Cataluña
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (20, 39); -- modext1 en Extremadura
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (21, 42); -- modgal1 en Galicia
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (22, 42); -- modgal2 en Galicia
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (23, 46); -- modmad1 en Madrid
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (24, 48); -- modmur1 en Murcia
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (25, 50); -- modnav1 en Navarra
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (26, 52); -- modpv1 en País Vasco
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (27, 52); -- modpv2 en País Vasco
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (28, 56); -- modrio1 en La Rioja
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (29, 58); -- modval1 en Comunidad Valenciana
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (30, 58); -- modval2 en Comunidad Valenciana
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (31, 61); -- modceu1 en Ceuta
INSERT INTO `moderadores_zonas` (`usuario_id`, `zona_id`) VALUES (32, 63); -- modmel1 en Melilla


-- Proveedores 
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678A', 'Proveedor 1', 'Calle Proveedor 1', '900000001', 33, 1);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678B', 'Proveedor 2', 'Calle Proveedor 2', '900000002', 34, 9);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678C', 'Proveedor 3', 'Calle Proveedor 3', '900000003', 35, 20);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678D', 'Proveedor 4', 'Calle Proveedor 4', '900000004', 36, 29);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678E', 'Proveedor 5', 'Calle Proveedor 5', '900000005', 37, 34);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678F', 'Proveedor 6', 'Calle Proveedor 6', '900000006', 38, 39);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678G', 'Proveedor 7', 'Calle Proveedor 7', '900000007', 39, 42);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678H', 'Proveedor 8', 'Calle Proveedor 8', '900000008', 40 , 46);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678I', 'Proveedor 9', 'Calle Proveedor 9', '900000009', 41, 48);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678J', 'Proveedor 10', 'Calle Proveedor 10', '900000010', 42, 50);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678K', 'Proveedor 11', 'Calle Proveedor 11', '900000011', 43, 52);
INSERT INTO `proveedores` (`nif_cif`, `razon_social`, `direccion`, `telefono`, `usuario_id`, `zona_id`) VALUES ('12345678L', 'Proveedor 12', 'Calle Proveedor 12', '900000012', 44, 58);


-- Anuncios
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 1', 'Descripción del anuncio 1', 'Tienda 1', '2020-01-01', '2020-01-31', 10.00, 20.00, 1, 1, 33, 45);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 2', 'Descripción del anuncio 2', 'Tienda 2', '2020-01-01', '2020-01-31', 20.00, 30.00, 9, 2, 34, 46);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 3', 'Descripción del anuncio 3', 'Tienda 3', '2020-01-01', '2020-01-31', 30.00, 40.00, 20, 3, 35, 47);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 4', 'Descripción del anuncio 4', 'Tienda 4', '2020-01-01', '2020-01-31', 40.00, 50.00, 29, 4, 36, 48);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 5', 'Descripción del anuncio 5', 'Tienda 5', '2020-01-01', '2020-01-31', 50.00, 60.00, 34, 5, 37, 49);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 6', 'Descripción del anuncio 6', 'Tienda 6', '2020-01-01', '2020-01-31', 60.00, 70.00, 39, 6, 38, 50);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 7', 'Descripción del anuncio 7', 'Tienda 7', '2020-01-01', '2020-01-31', 70.00, 80.00, 42, 7, 39, 51);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 8', 'Descripción del anuncio 8', 'Tienda 8', '2020-01-01', '2020-01-31', 80.00, 90.00, 46, 8, 40, 52);
INSERT INTO `anuncios` (`titulo`, `descripcion`, `tienda`, `fecha_inicio`, `fecha_fin`, `precio`, `precio_original`, `zona_id`, `categoria_id`, `proveedor_id`, `usuario_creador_id`) VALUES ('Anuncio 9', 'Descripción del anuncio 9', 'Tienda 9', '2020-01-01', '2020-01-31', 90.00, 100.00, 48, 9, 41, 53);

-- 





