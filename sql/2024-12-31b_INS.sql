
USE `daw_proyectod`;

-- INSERCIÓN DE DATOS INICIALES

-- Roles de usuarios
INSERT INTO `roles` (`nombre`) VALUES ('sysadmin');
INSERT INTO `roles` (`nombre`) VALUES ('admin');
INSERT INTO `roles` (`nombre`) VALUES ('moderador');
INSERT INTO `roles` (`nombre`) VALUES ('patrocinador');
INSERT INTO `roles` (`nombre`) VALUES ('normal');





-- Inserciones de zonas
-- pais
INSERT INTO `zonas` (`clase`, `nombre`, `zona_padre_id`) VALUES ('País', 'España', NULL);

-- Usar variables temporales para almacenar el ID de España
SET @espana_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'España');

-- Insertar las comunidades usando la variable temporal
INSERT INTO `zonas` (`clase`, `nombre`, `zona_padre_id`) VALUES 
('Comunidad', 'Andalucía', @espana_id),
('Comunidad', 'Aragón', @espana_id),
('Comunidad', 'Asturias', @espana_id),
('Comunidad', 'Islas Baleares', @espana_id),
('Comunidad', 'Canarias', @espana_id),
('Comunidad', 'Cantabria', @espana_id),
('Comunidad', 'Castilla y León', @espana_id),
('Comunidad', 'Castilla-La Mancha', @espana_id),
('Comunidad', 'Cataluña', @espana_id),
('Comunidad', 'Extremadura', @espana_id),
('Comunidad', 'Galicia', @espana_id),
('Comunidad', 'Madrid', @espana_id),
('Comunidad', 'Murcia', @espana_id),
('Comunidad', 'Navarra', @espana_id),
('Comunidad', 'País Vasco', @espana_id),
('Comunidad', 'La Rioja', @espana_id),
('Comunidad', 'Comunidad Valenciana', @espana_id),
('Comunidad', 'Ceuta', @espana_id),
('Comunidad', 'Melilla', @espana_id);

-- Insertar las provincias usando subconsultas
SET @andalucia_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Andalucía' AND `clase` = 'Comunidad');
SET @aragon_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Aragón' AND `clase` = 'Comunidad');
SET @asturias_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Asturias' AND `clase` = 'Comunidad');
SET @baleares_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Islas Baleares' AND `clase` = 'Comunidad');
SET @canarias_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Canarias' AND `clase` = 'Comunidad');
SET @cantabria_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Cantabria' AND `clase` = 'Comunidad');
SET @cyl_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Castilla y León' AND `clase` = 'Comunidad');
SET @clm_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Castilla-La Mancha' AND `clase` = 'Comunidad');
SET @cataluna_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Cataluña' AND `clase` = 'Comunidad');
SET @extremadura_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Extremadura' AND `clase` = 'Comunidad');
SET @galicia_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Galicia' AND `clase` = 'Comunidad');
SET @madrid_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Madrid' AND `clase` = 'Comunidad');
SET @murcia_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Murcia' AND `clase` = 'Comunidad');
SET @navarra_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Navarra' AND `clase` = 'Comunidad');
SET @pv_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'País Vasco' AND `clase` = 'Comunidad');
SET @rioja_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'La Rioja' AND `clase` = 'Comunidad');
SET @valencia_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Comunidad Valenciana' AND `clase` = 'Comunidad');
SET @ceuta_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Ceuta' AND `clase` = 'Comunidad');
SET @melilla_id = (SELECT `id` FROM `zonas` WHERE `nombre` = 'Melilla' AND `clase` = 'Comunidad');




-- provincias
INSERT INTO `zonas` (`clase`, `nombre`, `zona_padre_id`) VALUES 
('Provincia', 'Almería', @andalucia_id),
('Provincia', 'Cádiz', @andalucia_id),
('Provincia', 'Córdoba', @andalucia_id),
('Provincia', 'Granada', @andalucia_id),
('Provincia', 'Huelva', @andalucia_id),
('Provincia', 'Jaén', @andalucia_id),
('Provincia', 'Málaga', @andalucia_id),
('Provincia', 'Sevilla', @andalucia_id),
('Provincia', 'Huesca', @aragon_id),
('Provincia', 'Teruel', @aragon_id),
('Provincia', 'Zaragoza', @aragon_id),
('Provincia', 'Asturias', @asturias_id),
('Provincia', 'Islas Baleares', @baleares_id),
('Provincia', 'Las Palmas', @canarias_id),
('Provincia', 'Santa Cruz de Tenerife', @canarias_id),
('Provincia', 'Cantabria', @cantabria_id),
('Provincia', 'Ávila', @cyl_id),
('Provincia', 'Burgos', @cyl_id),
('Provincia', 'León', @cyl_id),
('Provincia', 'Palencia', @cyl_id),
('Provincia', 'Salamanca', @cyl_id),
('Provincia', 'Segovia', @cyl_id),
('Provincia', 'Soria', @cyl_id),
('Provincia', 'Valladolid', @cyl_id),
('Provincia', 'Zamora', @cyl_id),
('Provincia', 'Albacete', @clm_id),
('Provincia', 'Ciudad Real', @clm_id),
('Provincia', 'Cuenca', @clm_id),
('Provincia', 'Guadalajara', @clm_id),
('Provincia', 'Toledo', @clm_id),
('Provincia', 'Barcelona', @cataluna_id),
('Provincia', 'Girona', @cataluna_id),
('Provincia', 'Lleida', @cataluna_id),
('Provincia', 'Tarragona', @cataluna_id),
('Provincia', 'Badajoz', @extremadura_id),
('Provincia', 'Cáceres', @extremadura_id),
('Provincia', 'A Coruña', @galicia_id),
('Provincia', 'Lugo', @galicia_id),
('Provincia', 'Ourense', @galicia_id),
('Provincia', 'Pontevedra', @galicia_id),
('Provincia', 'Madrid', @madrid_id),
('Provincia', 'Murcia', @murcia_id),
('Provincia', 'Navarra', @navarra_id),
('Provincia', 'Álava', @pv_id),
('Provincia', 'Gipuzkoa', @pv_id),
('Provincia', 'Bizkaia', @pv_id),
('Provincia', 'La Rioja', @rioja_id),
('Provincia', 'Alicante', @valencia_id),
('Provincia', 'Castellón', @valencia_id),
('Provincia', 'Valencia', @valencia_id),
('Provincia', 'Ceuta', @ceuta_id),
('Provincia', 'Melilla', @melilla_id);


-- Categorías
INSERT INTO `categorias` (`nombre`, `descripcion`, `categoria_padre_id`) VALUES 
('Electrónica', 'Todo tipo de aparatos electrónicos', NULL),
('Moda', 'Ropa y complementos', NULL),
('Hogar', 'Artículos para el hogar', NULL),
('Deporte', 'Artículos deportivos', NULL),
('Motor', 'Vehículos y accesorios', NULL),
('Inmobiliaria', 'Viviendas y locales', NULL),
('Viajes', 'Paquetes turísticos', NULL),
('Cultura y ocio', 'Espectáculos y eventos', NULL),
('Salud y belleza', 'Productos y servicios de salud y belleza', NULL),
('Juguetes', 'Todo tipo de juguetes y juegos', NULL),
('Alimentación', 'Productos alimenticios', NULL),
('Otros', NULL, NULL);

SET @electr_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Electrónica');
SET @moda_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Moda');
SET @hogar_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Hogar');
SET @deporte_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Deporte');
SET @motor_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Motor');
SET @inmob_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Inmobiliaria');
SET @viajes_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Viajes');
SET @cultura_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Cultura y ocio');
SET @salud_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Salud y belleza');
SET @juguetes_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Juguetes');
SET @aliment_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Alimentación');
SET @otros_id = (SELECT `id` FROM `categorias` WHERE `nombre` = 'Otros');


INSERT INTO `categorias` (`nombre`, `descripcion`, `categoria_padre_id`) VALUES 
('Móviles', 'Todo sobre teléfonos móviles, desde smartphones hasta móviles para personas mayores', @electr_id),
('Ordenadores', 'Ordenadores de sobremesa, portátiles, etc.', @electr_id),
('Televisores', 'Televisores de todo tipo', @electr_id),
('Cámaras', 'Cámaras de fotos y vídeo', @electr_id),
('Consolas', 'Consolas de videojuegos', @electr_id),
('Tablets', 'Tablets y e-books', @electr_id),
('Ropa de hombre', 'Ropa y complementos para hombre', @moda_id),
('Ropa de mujer', 'Ropa y complementos para mujer', @moda_id),
('Ropa de niño', 'Ropa y complementos para niños', @moda_id),
('Ropa de niña', 'Ropa y complementos para niñas', @moda_id),
('Ropa de bebé', 'Ropa y complementos para bebés', @moda_id),
('Zapatos de hombre', 'Zapatos para hombre', @moda_id),
('Zapatos de mujer', 'Zapatos para mujer', @moda_id),
('Zapatos de niño', 'Zapatos para niños', @moda_id),
('Zapatos de niña', 'Zapatos para niñas', @moda_id),
('Zapatos de bebé', 'Zapatos para bebés', @moda_id),
('Muebles', 'Muebles y decoración para el hogar', @hogar_id),
('Electrodomésticos', 'Electrodomésticos para el hogar', @hogar_id),
('Menaje', 'Menaje de cocina y hogar', @hogar_id),
('Textil', 'Textil para el hogar', @hogar_id),
('Ropa deportiva', 'Ropa y complementos deportivos', @deporte_id),
('Calzado deportivo', 'Calzado deportivo', @deporte_id),
('Material deportivo', 'Material deportivo', @deporte_id),
('Coches', 'Coches nuevos y de segunda mano', @motor_id),
('Motos', 'Motos nuevas y de segunda mano', @motor_id),
('Bicicletas', 'Bicicletas nuevas y de segunda mano', @motor_id),
('Recambios', 'Recambios y accesorios para vehículos', @motor_id),
('Pisos', 'Pisos en venta y alquiler', @inmob_id),
('Locales', 'Locales en venta y alquiler', @inmob_id),
('Terrenos', 'Terrenos en venta y alquiler', @inmob_id),
('Casas rurales', 'Casas rurales en venta y alquiler', @inmob_id),
('Hoteles', 'Hoteles en venta y alquiler', @inmob_id),
('Paquetes turísticos', 'Paquetes turísticos', @viajes_id),
('Cruceros', 'Cruceros', @viajes_id),
('Vuelos', 'Vuelos', @viajes_id),
('Espectáculos', 'Espectáculos y eventos', @cultura_id),
('Cine', 'Cine', @cultura_id),
('Teatro', 'Teatro', @cultura_id),
('Conciertos', 'Conciertos', @cultura_id),
('Spa', 'Spa y tratamientos de belleza', @salud_id),
('Gimnasio', 'Gimnasio y entrenamiento personal', @salud_id),
('Peluquería', 'Peluquería y estética', @salud_id),
('Juguetes de madera', 'Juguetes para infantes de madera', @juguetes_id),
('Juguetes electrónicos', 'Juguetes para infantes con componentes electrónicos', @juguetes_id),
('Juguetes de construcción', 'Juguetes para infantes de construcción', @juguetes_id),
('Juguetes de peluche', 'Juguetes para infantes de peluche', @juguetes_id),
('Frutas', 'Frutas frescas y de temporada', @aliment_id),
('Verduras', 'Verduras frescas y de temporada', @aliment_id),
('Carne', 'Carne fresca y de calidad', @aliment_id),
('Pescado', 'Pescado fresco y de calidad', @aliment_id);


-- Actualización del campo revisado
UPDATE `categorias`
SET `revisado` = TRUE;


-- Usuarios

SET @rol_sysadmin_id = (SELECT `id` FROM `roles` WHERE `nombre` = 'sysadmin');
SET @rol_admin_id = (SELECT `id` FROM `roles` WHERE `nombre` = 'admin');
SET @rol_moderador_id = (SELECT `id` FROM `roles` WHERE `nombre` = 'moderador');
SET @rol_patrocinador_id = (SELECT `id` FROM `roles` WHERE `nombre` = 'patrocinador');
SET @rol_normal_id = (SELECT `id` FROM `roles` WHERE `nombre` = 'normal');

-- Superadministrador
INSERT INTO `usuarios` (`id`, `email`, `password`, `nick`, `nombre`, `apellidos`, `fecha_registro`, `registro_confirmado`, `fecha_ultimo_acceso`, `accesos_fallidos`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `rol`) VALUES
(1, 'sysadmin@gmail.com', '$2y$13$40MMqNysNRGA3u3gZ/b.Cei.mFXodzxg1kkxR7zxQa0vb2658HLne', 'sysadmin', 'sysadmin', 'sysadmin', '2025-01-18 00:32:16', 1, NULL, 0, 0, NULL, NULL, 1),
(2, 'admin@gmail.com', '$2y$13$Ln8.sZvSQoHLpl2G7sKoKOD0QK.a2kte.aSaFL3naPtrV1ZJ8lGC2', 'admin', 'admin', 'admin', '2025-01-18 00:05:47', 1, '2025-01-18 00:37:55', 0, 0, NULL, NULL, 2),
(3, 'cliente1@gmail.com', '$2y$13$N2TV0PvHCaYXtncAAfliGeU.gZeIrfs6/Y6W.LQjO1b9OvZscdaQu', 'cliente1', 'cliente1', 'cliente1', '2025-01-18 00:27:47', 1, NULL, 0, 0, NULL, NULL, 5),
(4, 'patrocinador1@gmail.com', '$2y$13$tyvGlIEv5gvlt7bAAOr.7u6M0ord0mYamyazKHMrjSk3ma0khMwf2', 'patrocinador1', 'patrocinador1', 'patrocinador1', '2025-01-18 00:28:28', 1, NULL, 0, 0, NULL, NULL, 4),
(5, 'moderador1@gmail.com', '$2y$13$48lbR.34woipFUb/cPkfEOThNKvyBj3Rc5JqbydiSzreEzxkJe7NS', 'moderador1', 'moderador1', 'moderador1', '2025-01-18 00:31:03', 1, NULL, 0, 0, NULL, NULL, 3);

-- Moderadores de zonas
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (5, @andalucia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (6, @andalucia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (7, @andalucia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (8, @aragon_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (9, @asturias_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (10, @baleares_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (11, @canarias_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (12, @cantabria_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (13, @cyl_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (14, @cyl_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (15, @cyl_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (16, @clm_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (17, @clm_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (18, @cataluna_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (19, @cataluna_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (20, @extremadura_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (21, @galicia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (22, @galicia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (23, @madrid_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (24, @murcia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (25, @navarra_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (26, @pv_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (27, @pv_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (28, @rioja_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (29, @valencia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (30, @valencia_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (31, @ceuta_id); 
INSERT INTO `moderadores_zonas` (`moderador_id`, `zona_id`) VALUES (32, @melilla_id);



-- Proveedores
-- Inserciones de datos de prueba para la tabla de proveedores
INSERT INTO `proveedores` (`razon_social`, `telefono_contacto`, `email`, `zona_id`, `url_web`) VALUES 
('Proveedor 1 S.L.', '600123456', 'contacto1@proveedor1.com', 1, 'http://www.proveedor1.com'),
('Proveedor 2 S.L.', '600234567', 'contacto2@proveedor2.com', 2, 'http://www.proveedor2.com'),
('Proveedor 3 S.L.', '600345678', 'contacto3@proveedor3.com', 3, 'http://www.proveedor3.com'),
('Proveedor 4 S.L.', '600456789', 'contacto4@proveedor4.com', 4, 'http://www.proveedor4.com'),
('Proveedor 5 S.L.', '600567890', 'contacto5@proveedor5.com', 5, 'http://www.proveedor5.com'),
('Proveedor 6 S.L.', '600678901', 'contacto6@proveedor6.com', 6, 'http://www.proveedor6.com'),
('Proveedor 7 S.L.', '600789012', 'contacto7@proveedor7.com', 7, 'http://www.proveedor7.com'),
('Proveedor 8 S.L.', '600890123', 'contacto8@proveedor8.com', 8, 'http://www.proveedor8.com'),
('Proveedor 9 S.L.', '600901234', 'contacto9@proveedor9.com', 9, 'http://www.proveedor9.com'),
('Proveedor 10 S.L.', '600012345', 'contacto10@proveedor10.com', 10, 'http://www.proveedor10.com'),
('Proveedor 11 S.L.', '600123457', 'contacto11@proveedor11.com', 11, 'http://www.proveedor11.com'),
('Proveedor 12 S.L.', '600234568', 'contacto12@proveedor12.com', 12, 'http://www.proveedor12.com'),
('Proveedor 13 S.L.', '600345679', 'contacto13@proveedor13.com', 13, 'http://www.proveedor13.com'),
('Proveedor 14 S.L.', '600456780', 'contacto14@proveedor14.com', 14, 'http://www.proveedor14.com'),
('Proveedor 15 S.L.', '600567891', 'contacto15@proveedor15.com', 15, 'http://www.proveedor15.com');


-- Ofertas
-- Inserciones de datos de prueba para la tabla de ofertas
INSERT INTO `ofertas` (`titulo`, `descripcion`, `fecha_fin`, `precio_actual`, `precio_original`, `descuento`, `zona_id`, `categoria_id`, `proveedor_id`, `anuncio_destacado`, `usuario_creador_id`) VALUES 
('Oferta 1', 'Descripción de la oferta 1', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 5 DAY), 50.00, 100.00, 50.00, 2, 1, 1, FALSE, 51),
('Oferta 2', 'Descripción de la oferta 2', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 DAY), 75.00, 150.00, 50.00, 3, 2, 2, TRUE, 34),
('Oferta 3', 'Descripción de la oferta 3', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 DAY), 30.00, 60.00, 50.00, 4, 3, 3, FALSE, 53),
('Oferta 4', 'Descripción de la oferta 4', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 8 DAY), 40.00, 80.00, 50.00, 5, 4, 4, TRUE, 35),
('Oferta 5', 'Descripción de la oferta 5', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 9 DAY), 20.00, 40.00, 50.00, 6, 5, 5, FALSE, 55),
('Oferta 6', 'Descripción de la oferta 6', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 DAY), 60.00, 120.00, 50.00, 7, 6, 6, TRUE, 36),
('Oferta 7', 'Descripción de la oferta 7', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 5 DAY), 90.00, 180.00, 50.00, 8, 7, 7, FALSE, 57),
('Oferta 8', 'Descripción de la oferta 8', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 6 DAY), 80.00, 160.00, 50.00, 9, 8, 8, TRUE, 38),
('Oferta 9', 'Descripción de la oferta 9', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 DAY), 70.00, 140.00, 50.00, 10, 9, 9, FALSE, 59),
('Oferta 10', 'Descripción de la oferta 10', DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 8 DAY), 100.00, 200.00, 50.00, 11, 10, 10, TRUE, 39);


-- Comentarios
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (1, 'Comentario 1', 45);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (1, 'Comentario 2', 46);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (1, 'Comentario 3', 47);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (2, 'Comentario 4', 48);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (2, 'Comentario 5', 49);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (2, 'Comentario 6', 50);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (3, 'Comentario 7', 51);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (3, 'Comentario 8', 52);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (3, 'Comentario 9', 53);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (4, 'Comentario 10', 54);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (4, 'Comentario 11', 55);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (4, 'Comentario 12', 56);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (5, 'Comentario 13', 57);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (5, 'Comentario 14', 58);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (5, 'Comentario 15', 59);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (6, 'Comentario 16', 60);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (6, 'Comentario 17', 61);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (6, 'Comentario 18', 62);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (7, 'Comentario 19', 63);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (7, 'Comentario 20', 64);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (7, 'Comentario 21', 65);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (8, 'Comentario 22', 66);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (8, 'Comentario 23', 67);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (8, 'Comentario 24', 68);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (9, 'Comentario 25', 69);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (9, 'Comentario 26', 45);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`) VALUES (9, 'Comentario 27', 46);

SET @comentario1_id = (SELECT `id` FROM `comentarios` WHERE `texto` = 'Comentario 1');
SET @comentario2_id = (SELECT `id` FROM `comentarios` WHERE `texto` = 'Comentario 2');
SET @comentario16_id = (SELECT `id` FROM `comentarios` WHERE `texto` = 'Comentario 16');

INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`, `comentario_origen_id`) VALUES (1, 'Respuesta Comentario 1', 46, @comentario1_id);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`, `comentario_origen_id`) VALUES (1, 'Respuesta Comentario 2', 47, @comentario2_id);
INSERT INTO `comentarios` (`oferta_id`, `texto`, `usuario_id`, `comentario_origen_id`) VALUES (6, 'Respuesta Comentario 16', 48, @comentario16_id);


-- Mensajes

INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 1', 45, 46);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 2', 46, 47);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 3', 47, 45);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 4', 48, 49);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 5', 49, 50);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 6', 50, 48);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 7', 51, 52);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 8', 52, 53);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 9', 53, 51);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 10', 54, 55);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 11', 55, 56);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 12', 56, 54);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 13', 57, 58);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 14', 58, 59);
INSERT INTO `mensajes` (`texto`, `usuario_origen_id`, `usuario_destino_id`) VALUES ('Mensaje 15', 59, 57);


-- Etiquetas
INSERT INTO `etiquetas` (`nombre`) VALUES ('Navidad');
INSERT INTO `etiquetas` (`nombre`) VALUES ('Rebajas');
INSERT INTO `etiquetas` (`nombre`) VALUES ('Verano');
INSERT INTO `etiquetas` (`nombre`) VALUES ('Últimas unidades');


-- Valoraciones de ofertas
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (1, 45, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (1, 46, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (1, 47, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (2, 48, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (2, 49, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (2, 50, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (3, 51, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (3, 52, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (3, 53, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (4, 54, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (4, 55, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (4, 56, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (5, 57, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (5, 58, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (5, 59, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (6, 60, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (6, 61, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (6, 62, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (7, 63, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (7, 64, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (7, 65, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (8, 66, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (8, 67, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (8, 68, 1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (9, 69, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (9, 45, -1);
INSERT INTO `ofertas_valoraciones` (`oferta_id`, `usuario_id`, `valoracion`) VALUES (9, 46, -1);



-- Ofertas etiquetas
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (1, 1);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (1, 2);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (2, 2);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (2, 3);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (3, 3);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (3, 4);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (4, 4);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (4, 1);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (5, 1);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (5, 2);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (6, 2);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (6, 3);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (7, 3);
INSERT INTO `ofertas_etiquetas` (`oferta_id`, `etiqueta_id`) VALUES (7, 4);


-- seguimientos
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (45, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (45, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (45, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (46, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (46, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (46, 6);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (47, 7);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (47, 8);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (47, 9);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (48, 10);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (48, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (48, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (49, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (49, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (49, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (50, 6);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (50, 7);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (50, 8);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (51, 9);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (51, 10);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (51, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (52, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (52, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (52, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (53, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (53, 6);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (53, 7);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (54, 8);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (54, 9);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (54, 10);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (55, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (55, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (55, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (56, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (56, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (56, 6);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (57, 7);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (57, 8);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (57, 9);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (58, 10);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (58, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (58, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (59, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (59, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (59, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (60, 6);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (60, 7);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (60, 8);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (61, 9);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (61, 10);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (61, 1);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (62, 2);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (62, 3);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (62, 4);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (63, 5);
INSERT INTO `seguimientos` (`usuario_id`, `oferta_id`) VALUES (63, 6);



-- Incidencias

INSERT INTO `incidencias` (`fecha_hora`, `clase`, `texto`, `usuario_origen_id`, `usuario_destino_id`, `oferta_id`, `comentario_id`, `fecha_lectura`, `fecha_aceptado`) VALUES 
(CURRENT_TIMESTAMP, 'Reclamación', 'El producto no coincide con la descripción.', 1, 2, 1, NULL, NULL, NULL),
(CURRENT_TIMESTAMP, 'Denuncia', 'Comentario inapropiado.', 3, 4, NULL, 1, NULL, NULL);


-- logs

-- Inserciones de datos de prueba para la tabla de logs
INSERT INTO `logs` (`fecha_hora`, `nivel`, `modulo`, `descripcion`) VALUES 
(CURRENT_TIMESTAMP, 'INFO', 'Autenticación', 'Usuario admin1 inició sesión correctamente.'),
(CURRENT_TIMESTAMP, 'WARNING', 'Base de Datos', 'El espacio en disco está por debajo del 10%.'),
(CURRENT_TIMESTAMP, 'ERROR', 'API', 'Error al conectar con el servicio externo.'),
(CURRENT_TIMESTAMP, 'INFO', 'Registro', 'Nuevo usuario registrado con éxito.'),
(CURRENT_TIMESTAMP, 'ERROR', 'Autenticación', 'Intento de inicio de sesión fallido para el usuario admin2.');







