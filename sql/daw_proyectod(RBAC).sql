-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2025 a las 18:04:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw_proyectod`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `oferta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `titulo`, `descripcion`, `precio`, `fecha`, `oferta_id`) VALUES
(1, 'Anuncio Oferta 2', 'Descripcion del anuncio de la Oferta 2', 75.00, '2025-01-23 16:53:07', 2),
(2, 'Anuncio Oferta 4', 'Descripcion del anuncio de la Oferta 4', 40.00, '2025-01-25 16:53:07', 4),
(3, 'Anuncio Oferta 6', 'Descripcion del anuncio de la Oferta 6', 60.00, '2025-01-27 16:53:07', 6),
(4, 'Anuncio Oferta 8', 'Descripcion del anuncio de la Oferta 8', 80.00, '2025-01-23 16:53:07', 8),
(5, 'Anuncio Oferta 10', 'Descripcion del anuncio de la Oferta 10', 100.00, '2025-01-25 16:53:07', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1737130748),
('admin', '3', 1737130748),
('admin', '70', 1737133335),
('moderador', '5', 1737130748),
('moderador', '6', 1737130748),
('patrocinador', '33', 1737130748),
('patrocinador', '34', 1737130748),
('sysadmin', '1', 1737130748),
('usuario', '45', 1737130748),
('usuario', '46', 1737130748),
('usuario', '47', 1737130748);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` longblob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('accederFichaUsuariosAdmin', 2, 'Permiso para acceder a la ficha de usuarios del administrador', NULL, NULL, 1737133083, 1737133083),
('admin', 1, 'Administrador del sistema', NULL, NULL, 1737130748, 1737130748),
('bloquearOferta', 2, 'Bloquear o desbloquear ofertas', NULL, NULL, 1737130849, 1737130849),
('bloquearUsuario', 2, 'Bloquear o desbloquear usuarios', NULL, NULL, 1737130849, 1737130849),
('crearCategoria', 2, 'Crear nuevas categorías en el sistema', NULL, NULL, 1737130849, 1737130849),
('crearOferta', 2, 'Crear nuevas ofertas en el sistema', NULL, NULL, 1737130849, 1737130849),
('crearUsuario', 2, 'Crear nuevos usuarios en el sistema', NULL, NULL, 1737130849, 1737130849),
('editarCategoria', 2, 'Editar categorías existentes', NULL, NULL, 1737130849, 1737130849),
('editarOferta', 2, 'Editar ofertas existentes', NULL, NULL, 1737130849, 1737130849),
('editarUsuario', 2, 'Editar la información de los usuarios', NULL, NULL, 1737130849, 1737130849),
('moderador', 1, 'Moderador de contenido', NULL, NULL, 1737130748, 1737130748),
('patrocinador', 1, 'Patrocinador que gestiona sus propias ofertas', NULL, NULL, 1737130748, 1737130748),
('sysadmin', 1, 'Super Administrador del sistema', NULL, NULL, 1737130748, 1737130748),
('usuario', 1, 'Usuario normal del sistema', NULL, NULL, 1737130748, 1737130748);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'accederFichaUsuariosAdmin'),
('admin', 'bloquearOferta'),
('admin', 'bloquearUsuario'),
('admin', 'crearCategoria'),
('admin', 'crearOferta'),
('admin', 'crearUsuario'),
('admin', 'editarCategoria'),
('admin', 'editarOferta'),
('admin', 'editarUsuario'),
('moderador', 'bloquearOferta'),
('moderador', 'editarOferta'),
('patrocinador', 'crearOferta'),
('patrocinador', 'editarOferta'),
('sysadmin', 'accederFichaUsuariosAdmin'),
('sysadmin', 'bloquearOferta'),
('sysadmin', 'bloquearUsuario'),
('sysadmin', 'crearCategoria'),
('sysadmin', 'crearOferta'),
('sysadmin', 'crearUsuario'),
('sysadmin', 'editarCategoria'),
('sysadmin', 'editarOferta'),
('sysadmin', 'editarUsuario'),
('usuario', 'editarUsuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` longblob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT 0,
  `categoria_padre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `revisado`, `categoria_padre_id`) VALUES
(1, 'Electrónica', 'Todo tipo de aparatos electrónicos', 1, NULL),
(2, 'Moda', 'Ropa y complementos', 1, NULL),
(3, 'Hogar', 'Artículos para el hogar', 1, NULL),
(4, 'Deporte', 'Artículos deportivos', 1, NULL),
(5, 'Motor', 'Vehículos y accesorios', 1, NULL),
(6, 'Inmobiliaria', 'Viviendas y locales', 1, NULL),
(7, 'Viajes', 'Paquetes turísticos', 1, NULL),
(8, 'Cultura y ocio', 'Espectáculos y eventos', 1, NULL),
(9, 'Salud y belleza', 'Productos y servicios de salud y belleza', 1, NULL),
(10, 'Juguetes', 'Todo tipo de juguetes y juegos', 1, NULL),
(11, 'Alimentación', 'Productos alimenticios', 1, NULL),
(12, 'Otros', NULL, 1, NULL),
(13, 'Móviles', 'Todo sobre teléfonos móviles, desde smartphones hasta móviles para personas mayores', 1, 1),
(14, 'Ordenadores', 'Ordenadores de sobremesa, portátiles, etc.', 1, 1),
(15, 'Televisores', 'Televisores de todo tipo', 1, 1),
(16, 'Cámaras', 'Cámaras de fotos y vídeo', 1, 1),
(17, 'Consolas', 'Consolas de videojuegos', 1, 1),
(18, 'Tablets', 'Tablets y e-books', 1, 1),
(19, 'Ropa de hombre', 'Ropa y complementos para hombre', 1, 2),
(20, 'Ropa de mujer', 'Ropa y complementos para mujer', 1, 2),
(21, 'Ropa de niño', 'Ropa y complementos para niños', 1, 2),
(22, 'Ropa de niña', 'Ropa y complementos para niñas', 1, 2),
(23, 'Ropa de bebé', 'Ropa y complementos para bebés', 1, 2),
(24, 'Zapatos de hombre', 'Zapatos para hombre', 1, 2),
(25, 'Zapatos de mujer', 'Zapatos para mujer', 1, 2),
(26, 'Zapatos de niño', 'Zapatos para niños', 1, 2),
(27, 'Zapatos de niña', 'Zapatos para niñas', 1, 2),
(28, 'Zapatos de bebé', 'Zapatos para bebés', 1, 2),
(29, 'Muebles', 'Muebles y decoración para el hogar', 1, 3),
(30, 'Electrodomésticos', 'Electrodomésticos para el hogar', 1, 3),
(31, 'Menaje', 'Menaje de cocina y hogar', 1, 3),
(32, 'Textil', 'Textil para el hogar', 1, 3),
(33, 'Ropa deportiva', 'Ropa y complementos deportivos', 1, 4),
(34, 'Calzado deportivo', 'Calzado deportivo', 1, 4),
(35, 'Material deportivo', 'Material deportivo', 1, 4),
(36, 'Coches', 'Coches nuevos y de segunda mano', 1, 5),
(37, 'Motos', 'Motos nuevas y de segunda mano', 1, 5),
(38, 'Bicicletas', 'Bicicletas nuevas y de segunda mano', 1, 5),
(39, 'Recambios', 'Recambios y accesorios para vehículos', 1, 5),
(40, 'Pisos', 'Pisos en venta y alquiler', 1, 6),
(41, 'Locales', 'Locales en venta y alquiler', 1, 6),
(42, 'Terrenos', 'Terrenos en venta y alquiler', 1, 6),
(43, 'Casas rurales', 'Casas rurales en venta y alquiler', 1, 6),
(44, 'Hoteles', 'Hoteles en venta y alquiler', 1, 6),
(45, 'Paquetes turísticos', 'Paquetes turísticos', 1, 7),
(46, 'Cruceros', 'Cruceros', 1, 7),
(47, 'Vuelos', 'Vuelos', 1, 7),
(48, 'Espectáculos', 'Espectáculos y eventos', 1, 8),
(49, 'Cine', 'Cine', 1, 8),
(50, 'Teatro', 'Teatro', 1, 8),
(51, 'Conciertos', 'Conciertos', 1, 8),
(52, 'Spa', 'Spa y tratamientos de belleza', 1, 9),
(53, 'Gimnasio', 'Gimnasio y entrenamiento personal', 1, 9),
(54, 'Peluquería', 'Peluquería y estética', 1, 9),
(55, 'Juguetes de madera', 'Juguetes para infantes de madera', 1, 10),
(56, 'Juguetes electrónicos', 'Juguetes para infantes con componentes electrónicos', 1, 10),
(57, 'Juguetes de construcción', 'Juguetes para infantes de construcción', 1, 10),
(58, 'Juguetes de peluche', 'Juguetes para infantes de peluche', 1, 10),
(59, 'Frutas', 'Frutas frescas y de temporada', 1, 11),
(60, 'Verduras', 'Verduras frescas y de temporada', 1, 11),
(61, 'Carne', 'Carne fresca y de calidad', 1, 11),
(62, 'Pescado', 'Pescado fresco y de calidad', 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `texto` text NOT NULL,
  `comentario_origen_id` int(11) DEFAULT NULL,
  `cerrado` tinyint(1) DEFAULT 0,
  `denuncias` int(11) DEFAULT 0,
  `fecha_primer_denuncia` datetime DEFAULT NULL,
  `motivo_denuncia` text DEFAULT NULL,
  `bloqueado` tinyint(1) DEFAULT 0,
  `fecha_bloqueo` datetime DEFAULT NULL,
  `motivo_bloqueo` text DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `oferta_id`, `texto`, `comentario_origen_id`, `cerrado`, `denuncias`, `fecha_primer_denuncia`, `motivo_denuncia`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `usuario_id`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 1, 'Comentario 1', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 45, '2025-01-17 16:53:07', NULL),
(2, 1, 'Comentario 2', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 46, '2025-01-17 16:53:07', NULL),
(3, 1, 'Comentario 3', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 47, '2025-01-17 16:53:07', NULL),
(4, 2, 'Comentario 4', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 48, '2025-01-17 16:53:07', NULL),
(5, 2, 'Comentario 5', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 49, '2025-01-17 16:53:07', NULL),
(6, 2, 'Comentario 6', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 50, '2025-01-17 16:53:08', NULL),
(7, 3, 'Comentario 7', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 51, '2025-01-17 16:53:08', NULL),
(8, 3, 'Comentario 8', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 52, '2025-01-17 16:53:08', NULL),
(9, 3, 'Comentario 9', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 53, '2025-01-17 16:53:08', NULL),
(10, 4, 'Comentario 10', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 54, '2025-01-17 16:53:08', NULL),
(11, 4, 'Comentario 11', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 55, '2025-01-17 16:53:08', NULL),
(12, 4, 'Comentario 12', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 56, '2025-01-17 16:53:08', NULL),
(13, 5, 'Comentario 13', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 57, '2025-01-17 16:53:08', NULL),
(14, 5, 'Comentario 14', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 58, '2025-01-17 16:53:08', NULL),
(15, 5, 'Comentario 15', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 59, '2025-01-17 16:53:08', NULL),
(16, 6, 'Comentario 16', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 60, '2025-01-17 16:53:08', NULL),
(17, 6, 'Comentario 17', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 61, '2025-01-17 16:53:08', NULL),
(18, 6, 'Comentario 18', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 62, '2025-01-17 16:53:08', NULL),
(19, 7, 'Comentario 19', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 63, '2025-01-17 16:53:08', NULL),
(20, 7, 'Comentario 20', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 64, '2025-01-17 16:53:08', NULL),
(21, 7, 'Comentario 21', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 65, '2025-01-17 16:53:08', NULL),
(22, 8, 'Comentario 22', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 66, '2025-01-17 16:53:08', NULL),
(23, 8, 'Comentario 23', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 67, '2025-01-17 16:53:08', NULL),
(24, 8, 'Comentario 24', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 68, '2025-01-17 16:53:08', NULL),
(25, 9, 'Comentario 25', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 69, '2025-01-17 16:53:08', NULL),
(26, 9, 'Comentario 26', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 45, '2025-01-17 16:53:08', NULL),
(27, 9, 'Comentario 27', NULL, 0, 0, NULL, NULL, 0, NULL, NULL, 46, '2025-01-17 16:53:08', NULL),
(28, 1, 'Respuesta Comentario 1', 1, 0, 0, NULL, NULL, 0, NULL, NULL, 46, '2025-01-17 16:53:08', NULL),
(29, 1, 'Respuesta Comentario 2', 2, 0, 0, NULL, NULL, 0, NULL, NULL, 47, '2025-01-17 16:53:08', NULL),
(30, 6, 'Respuesta Comentario 16', 16, 0, 0, NULL, NULL, 0, NULL, NULL, 48, '2025-01-17 16:53:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Navidad', NULL),
(2, 'Rebajas', NULL),
(3, 'Verano', NULL),
(4, 'Últimas unidades', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `clase` varchar(50) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `usuario_origen_id` int(11) DEFAULT NULL,
  `usuario_destino_id` int(11) DEFAULT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  `fecha_lectura` datetime DEFAULT NULL,
  `fecha_aceptado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `fecha_hora`, `clase`, `texto`, `usuario_origen_id`, `usuario_destino_id`, `oferta_id`, `comentario_id`, `fecha_lectura`, `fecha_aceptado`) VALUES
(1, '2025-01-17 16:53:08', 'Reclamación', 'El producto no coincide con la descripción.', 1, 2, 1, NULL, NULL, NULL),
(2, '2025-01-17 16:53:08', 'Denuncia', 'Comentario inapropiado.', 3, 4, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `nivel` varchar(20) DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `fecha_hora`, `nivel`, `modulo`, `descripcion`) VALUES
(1, '2025-01-17 16:53:08', 'INFO', 'Autenticación', 'Usuario admin1 inició sesión correctamente.'),
(2, '2025-01-17 16:53:08', 'WARNING', 'Base de Datos', 'El espacio en disco está por debajo del 10%.'),
(3, '2025-01-17 16:53:08', 'ERROR', 'API', 'Error al conectar con el servicio externo.'),
(4, '2025-01-17 16:53:08', 'INFO', 'Registro', 'Nuevo usuario registrado con éxito.'),
(5, '2025-01-17 16:53:08', 'ERROR', 'Autenticación', 'Intento de inicio de sesión fallido para el usuario admin2.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `texto` text NOT NULL,
  `usuario_origen_id` int(11) DEFAULT NULL,
  `usuario_destino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `fecha_hora`, `texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES
(1, '2025-01-17 16:53:08', 'Mensaje 1', 45, 46),
(2, '2025-01-17 16:53:08', 'Mensaje 2', 46, 47),
(3, '2025-01-17 16:53:08', 'Mensaje 3', 47, 45),
(4, '2025-01-17 16:53:08', 'Mensaje 4', 48, 49),
(5, '2025-01-17 16:53:08', 'Mensaje 5', 49, 50),
(6, '2025-01-17 16:53:08', 'Mensaje 6', 50, 48),
(7, '2025-01-17 16:53:08', 'Mensaje 7', 51, 52),
(8, '2025-01-17 16:53:08', 'Mensaje 8', 52, 53),
(9, '2025-01-17 16:53:08', 'Mensaje 9', 53, 51),
(10, '2025-01-17 16:53:08', 'Mensaje 10', 54, 55),
(11, '2025-01-17 16:53:08', 'Mensaje 11', 55, 56),
(12, '2025-01-17 16:53:08', 'Mensaje 12', 56, 54),
(13, '2025-01-17 16:53:08', 'Mensaje 13', 57, 58),
(14, '2025-01-17 16:53:08', 'Mensaje 14', 58, 59),
(15, '2025-01-17 16:53:08', 'Mensaje 15', 59, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderadores_zonas`
--

CREATE TABLE `moderadores_zonas` (
  `id` int(11) NOT NULL,
  `moderador_id` int(11) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `moderadores_zonas`
--

INSERT INTO `moderadores_zonas` (`id`, `moderador_id`, `zona_id`) VALUES
(1, 5, 2),
(2, 6, 2),
(3, 7, 2),
(4, 8, 3),
(5, 9, 4),
(6, 10, 5),
(7, 11, 6),
(8, 12, 7),
(9, 13, 8),
(10, 14, 8),
(11, 15, 8),
(12, 16, 9),
(13, 17, 9),
(14, 18, 10),
(15, 19, 10),
(16, 20, 11),
(17, 21, 12),
(18, 22, 12),
(19, 23, 13),
(20, 24, 14),
(21, 25, 15),
(22, 26, 16),
(23, 27, 16),
(24, 28, 17),
(25, 29, 18),
(26, 30, 18),
(27, 31, 19),
(28, 32, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `url_externa` varchar(255) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT current_timestamp(),
  `fecha_fin` datetime DEFAULT NULL,
  `precio_actual` decimal(10,2) DEFAULT NULL,
  `precio_original` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `anuncio_destacado` tinyint(1) DEFAULT 0,
  `patrocinada` tinyint(1) DEFAULT 0,
  `destacada` tinyint(1) DEFAULT 0,
  `estado` varchar(20) NOT NULL DEFAULT 'visible',
  `denuncias` int(11) DEFAULT 0,
  `fecha_primer_denuncia` datetime DEFAULT NULL,
  `motivo_denuncia` text DEFAULT NULL,
  `fecha_bloqueo` datetime DEFAULT NULL,
  `motivo_bloqueo` text DEFAULT NULL,
  `cerrado_comentar` tinyint(1) DEFAULT 0,
  `usuario_creador_id` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `usuario_modificador_id` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `titulo`, `descripcion`, `url_externa`, `fecha_inicio`, `fecha_fin`, `precio_actual`, `precio_original`, `descuento`, `zona_id`, `categoria_id`, `proveedor_id`, `anuncio_destacado`, `patrocinada`, `destacada`, `estado`, `denuncias`, `fecha_primer_denuncia`, `motivo_denuncia`, `fecha_bloqueo`, `motivo_bloqueo`, `cerrado_comentar`, `usuario_creador_id`, `fecha_creacion`, `usuario_modificador_id`, `fecha_modificacion`) VALUES
(1, 'Oferta 1', 'Descripción de la oferta 1', NULL, '2025-01-17 16:53:07', '2025-01-22 16:53:07', 50.00, 100.00, 50.00, 2, 1, 1, 0, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 51, '2025-01-17 16:53:07', NULL, NULL),
(2, 'Oferta 2', 'Descripción de la oferta 2', NULL, '2025-01-17 16:53:07', '2025-01-23 16:53:07', 75.00, 150.00, 50.00, 3, 2, 2, 1, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 34, '2025-01-17 16:53:07', NULL, NULL),
(3, 'Oferta 3', 'Descripción de la oferta 3', NULL, '2025-01-17 16:53:07', '2025-01-24 16:53:07', 30.00, 60.00, 50.00, 4, 3, 3, 0, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 53, '2025-01-17 16:53:07', NULL, NULL),
(4, 'Oferta 4', 'Descripción de la oferta 4', NULL, '2025-01-17 16:53:07', '2025-01-25 16:53:07', 40.00, 80.00, 50.00, 5, 4, 4, 1, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 35, '2025-01-17 16:53:07', NULL, NULL),
(5, 'Oferta 5', 'Descripción de la oferta 5', NULL, '2025-01-17 16:53:07', '2025-01-26 16:53:07', 20.00, 40.00, 50.00, 6, 5, 5, 0, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 55, '2025-01-17 16:53:07', NULL, NULL),
(6, 'Oferta 6', 'Descripción de la oferta 6', NULL, '2025-01-17 16:53:07', '2025-01-27 16:53:07', 60.00, 120.00, 50.00, 7, 6, 6, 1, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 36, '2025-01-17 16:53:07', NULL, NULL),
(7, 'Oferta 7', 'Descripción de la oferta 7', NULL, '2025-01-17 16:53:07', '2025-01-22 16:53:07', 90.00, 180.00, 50.00, 8, 7, 7, 0, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 57, '2025-01-17 16:53:07', NULL, NULL),
(8, 'Oferta 8', 'Descripción de la oferta 8', NULL, '2025-01-17 16:53:07', '2025-01-23 16:53:07', 80.00, 160.00, 50.00, 9, 8, 8, 1, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 38, '2025-01-17 16:53:07', NULL, NULL),
(9, 'Oferta 9', 'Descripción de la oferta 9', NULL, '2025-01-17 16:53:07', '2025-01-24 16:53:07', 70.00, 140.00, 50.00, 10, 9, 9, 0, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 59, '2025-01-17 16:53:07', NULL, NULL),
(10, 'Oferta 10', 'Descripción de la oferta 10', NULL, '2025-01-17 16:53:07', '2025-01-25 16:53:07', 100.00, 200.00, 50.00, 11, 10, 10, 1, 0, 0, 'visible', 0, NULL, NULL, NULL, NULL, 0, 39, '2025-01-17 16:53:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_enlaces`
--

CREATE TABLE `ofertas_enlaces` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `texto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_etiquetas`
--

CREATE TABLE `ofertas_etiquetas` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `etiqueta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertas_etiquetas`
--

INSERT INTO `ofertas_etiquetas` (`id`, `oferta_id`, `etiqueta_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 3),
(5, 3, 3),
(6, 3, 4),
(7, 4, 4),
(8, 4, 1),
(9, 5, 1),
(10, 5, 2),
(11, 6, 2),
(12, 6, 3),
(13, 7, 3),
(14, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_imagenes`
--

CREATE TABLE `ofertas_imagenes` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_valoraciones`
--

CREATE TABLE `ofertas_valoraciones` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valoracion` tinyint(4) DEFAULT NULL CHECK (`valoracion` in (1,-1)),
  `fecha_valoracion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertas_valoraciones`
--

INSERT INTO `ofertas_valoraciones` (`id`, `oferta_id`, `usuario_id`, `valoracion`, `fecha_valoracion`) VALUES
(1, 1, 45, 1, '2025-01-17 16:53:08'),
(2, 1, 46, -1, '2025-01-17 16:53:08'),
(3, 1, 47, -1, '2025-01-17 16:53:08'),
(4, 2, 48, 1, '2025-01-17 16:53:08'),
(5, 2, 49, -1, '2025-01-17 16:53:08'),
(6, 2, 50, 1, '2025-01-17 16:53:08'),
(7, 3, 51, -1, '2025-01-17 16:53:08'),
(8, 3, 52, -1, '2025-01-17 16:53:08'),
(9, 3, 53, 1, '2025-01-17 16:53:08'),
(10, 4, 54, 1, '2025-01-17 16:53:08'),
(11, 4, 55, -1, '2025-01-17 16:53:08'),
(12, 4, 56, 1, '2025-01-17 16:53:08'),
(13, 5, 57, -1, '2025-01-17 16:53:08'),
(14, 5, 58, 1, '2025-01-17 16:53:08'),
(15, 5, 59, -1, '2025-01-17 16:53:08'),
(16, 6, 60, 1, '2025-01-17 16:53:08'),
(17, 6, 61, 1, '2025-01-17 16:53:08'),
(18, 6, 62, -1, '2025-01-17 16:53:08'),
(19, 7, 63, 1, '2025-01-17 16:53:08'),
(20, 7, 64, -1, '2025-01-17 16:53:08'),
(21, 7, 65, -1, '2025-01-17 16:53:08'),
(22, 8, 66, 1, '2025-01-17 16:53:08'),
(23, 8, 67, -1, '2025-01-17 16:53:08'),
(24, 8, 68, 1, '2025-01-17 16:53:08'),
(25, 9, 69, -1, '2025-01-17 16:53:08'),
(26, 9, 45, -1, '2025-01-17 16:53:08'),
(27, 9, 46, -1, '2025-01-17 16:53:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `aprobado` tinyint(1) DEFAULT 0,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `patrocinadores`
--

INSERT INTO `patrocinadores` (`id`, `usuario_id`, `nombre`, `aprobado`, `creado_en`, `actualizado_en`) VALUES
(1, 33, 'José', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(2, 34, 'María', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(3, 35, 'Carlos', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(4, 36, 'Ana', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(5, 37, 'Luis', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(6, 38, 'Elena', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(7, 39, 'Javier', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(8, 40, 'Laura', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(9, 41, 'David', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(10, 42, 'Patricia', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(11, 43, 'Miguel', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31'),
(12, 44, 'Sara', 0, '2025-01-16 14:34:31', '2025-01-16 14:34:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `telefono_contacto` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `zona_id` int(11) DEFAULT NULL,
  `url_web` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `telefono_contacto`, `email`, `zona_id`, `url_web`) VALUES
(1, 'Proveedor 1 S.L.', '600123456', 'contacto1@proveedor1.com', 1, 'http://www.proveedor1.com'),
(2, 'Proveedor 2 S.L.', '600234567', 'contacto2@proveedor2.com', 2, 'http://www.proveedor2.com'),
(3, 'Proveedor 3 S.L.', '600345678', 'contacto3@proveedor3.com', 3, 'http://www.proveedor3.com'),
(4, 'Proveedor 4 S.L.', '600456789', 'contacto4@proveedor4.com', 4, 'http://www.proveedor4.com'),
(5, 'Proveedor 5 S.L.', '600567890', 'contacto5@proveedor5.com', 5, 'http://www.proveedor5.com'),
(6, 'Proveedor 6 S.L.', '600678901', 'contacto6@proveedor6.com', 6, 'http://www.proveedor6.com'),
(7, 'Proveedor 7 S.L.', '600789012', 'contacto7@proveedor7.com', 7, 'http://www.proveedor7.com'),
(8, 'Proveedor 8 S.L.', '600890123', 'contacto8@proveedor8.com', 8, 'http://www.proveedor8.com'),
(9, 'Proveedor 9 S.L.', '600901234', 'contacto9@proveedor9.com', 9, 'http://www.proveedor9.com'),
(10, 'Proveedor 10 S.L.', '600012345', 'contacto10@proveedor10.com', 10, 'http://www.proveedor10.com'),
(11, 'Proveedor 11 S.L.', '600123457', 'contacto11@proveedor11.com', 11, 'http://www.proveedor11.com'),
(12, 'Proveedor 12 S.L.', '600234568', 'contacto12@proveedor12.com', 12, 'http://www.proveedor12.com'),
(13, 'Proveedor 13 S.L.', '600345679', 'contacto13@proveedor13.com', 13, 'http://www.proveedor13.com'),
(14, 'Proveedor 14 S.L.', '600456780', 'contacto14@proveedor14.com', 14, 'http://www.proveedor14.com'),
(15, 'Proveedor 15 S.L.', '600567891', 'contacto15@proveedor15.com', 15, 'http://www.proveedor15.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(2, 'admin'),
(3, 'moderador'),
(5, 'normal'),
(4, 'patrocinador'),
(1, 'sysadmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `oferta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`id`, `usuario_id`, `oferta_id`) VALUES
(1, 45, 1),
(2, 45, 2),
(3, 45, 3),
(4, 46, 4),
(5, 46, 5),
(6, 46, 6),
(7, 47, 7),
(8, 47, 8),
(9, 47, 9),
(10, 48, 10),
(11, 48, 1),
(12, 48, 2),
(13, 49, 3),
(14, 49, 4),
(15, 49, 5),
(16, 50, 6),
(17, 50, 7),
(18, 50, 8),
(19, 51, 9),
(20, 51, 10),
(21, 51, 1),
(22, 52, 2),
(23, 52, 3),
(24, 52, 4),
(25, 53, 5),
(26, 53, 6),
(27, 53, 7),
(28, 54, 8),
(29, 54, 9),
(30, 54, 10),
(31, 55, 1),
(32, 55, 2),
(33, 55, 3),
(34, 56, 4),
(35, 56, 5),
(36, 56, 6),
(37, 57, 7),
(38, 57, 8),
(39, 57, 9),
(40, 58, 10),
(41, 58, 1),
(42, 58, 2),
(43, 59, 3),
(44, 59, 4),
(45, 59, 5),
(46, 60, 6),
(47, 60, 7),
(48, 60, 8),
(49, 61, 9),
(50, 61, 10),
(51, 61, 1),
(52, 62, 2),
(53, 62, 3),
(54, 62, 4),
(55, 63, 5),
(56, 63, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `registro_confirmado` tinyint(1) DEFAULT 0,
  `fecha_ultimo_acceso` datetime DEFAULT NULL,
  `accesos_fallidos` int(11) DEFAULT 0,
  `bloqueado` tinyint(1) DEFAULT 0,
  `fecha_bloqueo` datetime DEFAULT NULL,
  `motivo_bloqueo` varchar(255) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nick`, `nombre`, `apellidos`, `fecha_registro`, `registro_confirmado`, `fecha_ultimo_acceso`, `accesos_fallidos`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `rol`) VALUES
(1, 'super@mail.com', 'passsuper', 'superadmin', 'Paco', 'Giménez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 1),
(2, 'admin1@mail.com', 'passadmin1', 'admin1', 'Juan', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 2),
(3, 'admin2@mail.com', 'passadmin2', 'admin2', 'Ana', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 2),
(4, 'admin3@mail.com', 'passadmin3', 'admin3', 'Luis', 'Sánchez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 2),
(5, 'modand1@mail.com', 'passmodand1', 'modand1', 'María', 'López', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(6, 'modand2@mail.com', 'passmodand2', 'modand2', 'Pedro', 'Fernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(7, 'modand3@mail.com', 'passmodand3', 'modand3', 'Carmen', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(8, 'modarg1@mail.com', 'passmodarg1', 'modarg1', 'Antonio', 'Rodríguez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(9, 'modast1@mail.com', 'passmodast1', 'modast1', 'Isabel', 'Pérez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(10, 'modbal1@mail.com', 'passmodbal1', 'modbal1', 'Manuel', 'Hernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(11, 'modcan1@mail.com', 'passmodcan1', 'modcan1', 'Rosa', 'Jiménez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(12, 'modcant1@mail.com', 'passmodcant1', 'modcant1', 'Miguel', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(13, 'modcyl1@mail.com', 'passmodcyl1', 'modcyl1', 'Francisco', 'Torres', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(14, 'modcyl2@mail.com', 'passmodcyl2', 'modcyl2', 'Laura', 'Sanz', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(15, 'modcyl3@mail.com', 'passmodcyl3', 'modcyl3', 'Javier', 'Ibáñez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(16, 'modclm1@mail.com', 'passmodclm1', 'modclm1', 'Marina', 'Garrido', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(17, 'modclm2@mail.com', 'passmodclm2', 'modclm2', 'Carlos', 'Gutiérrez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(18, 'modcat1@mail.com', 'passmodcat1', 'modcat1', 'Sara', 'Martín', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(19, 'modcat2@mail.com', 'passmodcat2', 'modcat2', 'David', 'Vega', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(20, 'modext1@mail.com', 'passmodext1', 'modext1', 'Elena', 'Ortega', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(21, 'modgal1@mail.com', 'passmodgal1', 'modgal1', 'Jorge', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(22, 'modgal2@mail.com', 'passmodgal2', 'modgal2', 'Marta', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(23, 'modmad1@mail.com', 'passmodmad1', 'modmad1', 'Víctor', 'Sánchez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(24, 'modmur1@mail.com', 'passmodmur1', 'modmur1', 'Patricia', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(25, 'modnav1@mail.com', 'passmodnav1', 'modnav1', 'Roberto', 'Fernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(26, 'modpv1@mail.com', 'passmodpv1', 'modpv1', 'Eva', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(27, 'modpv2@mail.com', 'passmodpv2', 'modpv2', 'Adrián', 'Sanz', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(28, 'modrio1@mail.com', 'passmodrio1', 'modrio1', 'Cristina', 'Torres', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(29, 'modval1@mail.com', 'passmodval1', 'modval1', 'Sergio', 'Ibáñez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(30, 'modval2@mail.com', 'passmodval2', 'modval2', 'Nuria', 'Garrido', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(31, 'modceu1@mail.com', 'passmodceu1', 'modceu1', 'Óscar', 'Gutiérrez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(32, 'modmel1@mail.com', 'passmodmel1', 'modmel1', 'Raquel', 'Martín', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 3),
(33, 'patro1@mail.com', 'passpatro1', 'patro1', 'José', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(34, 'patro2@mail.com', 'passpatro2', 'patro2', 'María', 'López', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(35, 'patro3@mail.com', 'passpatro3', 'patro3', 'Carlos', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(36, 'patro4@mail.com', 'passpatro4', 'patro4', 'Ana', 'Sánchez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(37, 'patro5@mail.com', 'passpatro5', 'patro5', 'Luis', 'Martín', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(38, 'patro6@mail.com', 'passpatro6', 'patro6', 'Elena', 'Pérez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(39, 'patro7@mail.com', 'passpatro7', 'patro7', 'Javier', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(40, 'patro8@mail.com', 'passpatro8', 'patro8', 'Laura', 'Hernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(41, 'patro9@mail.com', 'passpatro9', 'patro9', 'David', 'Jiménez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(42, 'patro10@mail.com', 'passpatro10', 'patro10', 'Patricia', 'Ruiz', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(43, 'patro11@mail.com', 'passpatro11', 'patro11', 'Miguel', 'Fernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(44, 'patro12@mail.com', 'passpatro12', 'patro12', 'Sara', 'Torres', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 4),
(45, 'usu1@mail.com', 'passusu1', 'usu1', 'Antonio', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(46, 'usu2@mail.com', 'passusu2', 'usu2', 'María', 'López', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(47, 'usu3@mail.com', 'passusu3', 'usu3', 'Carlos', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(48, 'usu4@mail.com', 'passusu4', 'usu4', 'Ana', 'Sánchez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(49, 'usu5@mail.com', 'passusu5', 'usu5', 'Luis', 'Martín', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(50, 'usu6@mail.com', 'passusu6', 'usu6', 'Elena', 'Pérez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(51, 'usu7@mail.com', 'passusu7', 'usu7', 'Javier', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(52, 'usu8@mail.com', 'passusu8', 'usu8', 'Laura', 'Hernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(53, 'usu9@mail.com', 'passusu9', 'usu9', 'David', 'Jiménez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(54, 'usu10@mail.com', 'passusu10', 'usu10', 'Patricia', 'Ruiz', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(55, 'usu11@mail.com', 'passusu11', 'usu11', 'Miguel', 'Fernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(56, 'usu12@mail.com', 'passusu12', 'usu12', 'Sara', 'Torres', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(57, 'usu13@mail.com', 'passusu13', 'usu13', 'Antonio', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(58, 'usu14@mail.com', 'passusu14', 'usu14', 'María', 'Martínez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(59, 'usu15@mail.com', 'passusu15', 'usu15', 'Carlos', 'López', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(60, 'usu16@mail.com', 'passusu16', 'usu16', 'Ana', 'García', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(61, 'usu17@mail.com', 'passusu17', 'usu17', 'Luis', 'Sánchez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(62, 'usu18@mail.com', 'passusu18', 'usu18', 'Elena', 'Martín', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(63, 'usu19@mail.com', 'passusu19', 'usu19', 'Javier', 'Pérez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(64, 'usu20@mail.com', 'passusu20', 'usu20', 'Laura', 'Gómez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(65, 'usu21@mail.com', 'passusu21', 'usu21', 'David', 'Hernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(66, 'usu22@mail.com', 'passusu22', 'usu22', 'Patricia', 'Jiménez', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(67, 'usu23@mail.com', 'passusu23', 'usu23', 'Miguel', 'Ruiz', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(68, 'usu24@mail.com', 'passusu24', 'usu24', 'Sara', 'Fernández', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(69, 'usu25@mail.com', 'passusu25', 'usu25', 'Antonio', 'Torres', '2025-01-17 16:53:07', 0, NULL, 0, 0, NULL, NULL, 5),
(70, 'manolo@gmail.com', '$2y$13$vhIGaHLuJt/s3XH4KvQiP.tgatcAciQl5EE5P1wI.zCfOvhQtYZpa', 'manolito', 'manolo', 'perez', '2025-01-17 17:59:42', 1, '2025-01-17 18:01:10', 0, 0, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_categorias`
--

CREATE TABLE `usuarios_categorias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_etiquetas`
--

CREATE TABLE `usuarios_etiquetas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `etiqueta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_zonas`
--

CREATE TABLE `usuarios_zonas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `zona_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `clase` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `zona_padre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `clase`, `nombre`, `zona_padre_id`) VALUES
(1, 'País', 'España', NULL),
(2, 'Comunidad', 'Andalucía', 1),
(3, 'Comunidad', 'Aragón', 1),
(4, 'Comunidad', 'Asturias', 1),
(5, 'Comunidad', 'Islas Baleares', 1),
(6, 'Comunidad', 'Canarias', 1),
(7, 'Comunidad', 'Cantabria', 1),
(8, 'Comunidad', 'Castilla y León', 1),
(9, 'Comunidad', 'Castilla-La Mancha', 1),
(10, 'Comunidad', 'Cataluña', 1),
(11, 'Comunidad', 'Extremadura', 1),
(12, 'Comunidad', 'Galicia', 1),
(13, 'Comunidad', 'Madrid', 1),
(14, 'Comunidad', 'Murcia', 1),
(15, 'Comunidad', 'Navarra', 1),
(16, 'Comunidad', 'País Vasco', 1),
(17, 'Comunidad', 'La Rioja', 1),
(18, 'Comunidad', 'Comunidad Valenciana', 1),
(19, 'Comunidad', 'Ceuta', 1),
(20, 'Comunidad', 'Melilla', 1),
(21, 'Provincia', 'Almería', 2),
(22, 'Provincia', 'Cádiz', 2),
(23, 'Provincia', 'Córdoba', 2),
(24, 'Provincia', 'Granada', 2),
(25, 'Provincia', 'Huelva', 2),
(26, 'Provincia', 'Jaén', 2),
(27, 'Provincia', 'Málaga', 2),
(28, 'Provincia', 'Sevilla', 2),
(29, 'Provincia', 'Huesca', 3),
(30, 'Provincia', 'Teruel', 3),
(31, 'Provincia', 'Zaragoza', 3),
(32, 'Provincia', 'Asturias', 4),
(33, 'Provincia', 'Islas Baleares', 5),
(34, 'Provincia', 'Las Palmas', 6),
(35, 'Provincia', 'Santa Cruz de Tenerife', 6),
(36, 'Provincia', 'Cantabria', 7),
(37, 'Provincia', 'Ávila', 8),
(38, 'Provincia', 'Burgos', 8),
(39, 'Provincia', 'León', 8),
(40, 'Provincia', 'Palencia', 8),
(41, 'Provincia', 'Salamanca', 8),
(42, 'Provincia', 'Segovia', 8),
(43, 'Provincia', 'Soria', 8),
(44, 'Provincia', 'Valladolid', 8),
(45, 'Provincia', 'Zamora', 8),
(46, 'Provincia', 'Albacete', 9),
(47, 'Provincia', 'Ciudad Real', 9),
(48, 'Provincia', 'Cuenca', 9),
(49, 'Provincia', 'Guadalajara', 9),
(50, 'Provincia', 'Toledo', 9),
(51, 'Provincia', 'Barcelona', 10),
(52, 'Provincia', 'Girona', 10),
(53, 'Provincia', 'Lleida', 10),
(54, 'Provincia', 'Tarragona', 10),
(55, 'Provincia', 'Badajoz', 11),
(56, 'Provincia', 'Cáceres', 11),
(57, 'Provincia', 'A Coruña', 12),
(58, 'Provincia', 'Lugo', 12),
(59, 'Provincia', 'Ourense', 12),
(60, 'Provincia', 'Pontevedra', 12),
(61, 'Provincia', 'Madrid', 13),
(62, 'Provincia', 'Murcia', 14),
(63, 'Provincia', 'Navarra', 15),
(64, 'Provincia', 'Álava', 16),
(65, 'Provincia', 'Gipuzkoa', 16),
(66, 'Provincia', 'Bizkaia', 16),
(67, 'Provincia', 'La Rioja', 17),
(68, 'Provincia', 'Alicante', 18),
(69, 'Provincia', 'Castellón', 18),
(70, 'Provincia', 'Valencia', 18),
(71, 'Provincia', 'Ceuta', 19),
(72, 'Provincia', 'Melilla', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_padre_id` (`categoria_padre_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `comentario_origen_id` (`comentario_origen_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_origen_id` (`usuario_origen_id`),
  ADD KEY `usuario_destino_id` (`usuario_destino_id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_origen_id` (`usuario_origen_id`),
  ADD KEY `usuario_destino_id` (`usuario_destino_id`);

--
-- Indices de la tabla `moderadores_zonas`
--
ALTER TABLE `moderadores_zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderador_id` (`moderador_id`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zona_id` (`zona_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `usuario_creador_id` (`usuario_creador_id`),
  ADD KEY `usuario_modificador_id` (`usuario_modificador_id`);

--
-- Indices de la tabla `ofertas_enlaces`
--
ALTER TABLE `ofertas_enlaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`);

--
-- Indices de la tabla `ofertas_etiquetas`
--
ALTER TABLE `ofertas_etiquetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `etiqueta_id` (`etiqueta_id`);

--
-- Indices de la tabla `ofertas_imagenes`
--
ALTER TABLE `ofertas_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`);

--
-- Indices de la tabla `ofertas_valoraciones`
--
ALTER TABLE `ofertas_valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oferta_id` (`oferta_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `oferta_id` (`oferta_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nick` (`nick`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `etiqueta_id` (`etiqueta_id`);

--
-- Indices de la tabla `usuarios_zonas`
--
ALTER TABLE `usuarios_zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `zona_id` (`zona_id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clase` (`clase`,`nombre`),
  ADD KEY `zona_padre_id` (`zona_padre_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `moderadores_zonas`
--
ALTER TABLE `moderadores_zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ofertas_enlaces`
--
ALTER TABLE `ofertas_enlaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_etiquetas`
--
ALTER TABLE `ofertas_etiquetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ofertas_imagenes`
--
ALTER TABLE `ofertas_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_valoraciones`
--
ALTER TABLE `ofertas_valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_zonas`
--
ALTER TABLE `usuarios_zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`categoria_padre_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`comentario_origen_id`) REFERENCES `comentarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_ibfk_1` FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencias_ibfk_2` FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencias_ibfk_3` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencias_ibfk_4` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`usuario_origen_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`usuario_destino_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moderadores_zonas`
--
ALTER TABLE `moderadores_zonas`
  ADD CONSTRAINT `moderadores_zonas_ibfk_1` FOREIGN KEY (`moderador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moderadores_zonas_ibfk_2` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_ibfk_3` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_ibfk_4` FOREIGN KEY (`usuario_creador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_ibfk_5` FOREIGN KEY (`usuario_modificador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_enlaces`
--
ALTER TABLE `ofertas_enlaces`
  ADD CONSTRAINT `ofertas_enlaces_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_etiquetas`
--
ALTER TABLE `ofertas_etiquetas`
  ADD CONSTRAINT `ofertas_etiquetas_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_etiquetas_ibfk_2` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_imagenes`
--
ALTER TABLE `ofertas_imagenes`
  ADD CONSTRAINT `ofertas_imagenes_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas_valoraciones`
--
ALTER TABLE `ofertas_valoraciones`
  ADD CONSTRAINT `ofertas_valoraciones_ibfk_1` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertas_valoraciones_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD CONSTRAINT `patrocinadores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_categorias`
--
ALTER TABLE `usuarios_categorias`
  ADD CONSTRAINT `usuarios_categorias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_etiquetas`
--
ALTER TABLE `usuarios_etiquetas`
  ADD CONSTRAINT `usuarios_etiquetas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_etiquetas_ibfk_2` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_zonas`
--
ALTER TABLE `usuarios_zonas`
  ADD CONSTRAINT `usuarios_zonas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_zonas_ibfk_2` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `zonas_ibfk_1` FOREIGN KEY (`zona_padre_id`) REFERENCES `zonas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
