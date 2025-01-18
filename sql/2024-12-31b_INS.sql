
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
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('super@mail.com', 'passsuper', 'superadmin', 'Paco', 'Giménez', @rol_sysadmin_id); 
-- 1

-- Administradores
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES 
('admin1@mail.com', 'passadmin1', 'admin1', 'Juan', 'Martínez', 2),
('admin2@mail.com', 'passadmin2', 'admin2', 'Ana', 'García', 2),
('admin3@mail.com', 'passadmin3', 'admin3', 'Luis', 'Sánchez', 2);


-- Moderadores
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES 
('modand1@mail.com', 'passmodand1', 'modand1', 'María', 'López', 3),
('modand2@mail.com', 'passmodand2', 'modand2', 'Pedro', 'Fernández', 3),
('modand3@mail.com', 'passmodand3', 'modand3', 'Carmen', 'Gómez', 3),
('modarg1@mail.com', 'passmodarg1', 'modarg1', 'Antonio', 'Rodríguez', 3),
('modast1@mail.com', 'passmodast1', 'modast1', 'Isabel', 'Pérez', 3),
('modbal1@mail.com', 'passmodbal1', 'modbal1', 'Manuel', 'Hernández', 3),
('modcan1@mail.com', 'passmodcan1', 'modcan1', 'Rosa', 'Jiménez', 3),
('modcant1@mail.com', 'passmodcant1', 'modcant1', 'Miguel', 'Martínez', 3),
('modcyl1@mail.com', 'passmodcyl1', 'modcyl1', 'Francisco', 'Torres', 3),
('modcyl2@mail.com', 'passmodcyl2', 'modcyl2', 'Laura', 'Sanz', 3),
('modcyl3@mail.com', 'passmodcyl3', 'modcyl3', 'Javier', 'Ibáñez', 3),
('modclm1@mail.com', 'passmodclm1', 'modclm1', 'Marina', 'Garrido', 3),
('modclm2@mail.com', 'passmodclm2', 'modclm2', 'Carlos', 'Gutiérrez', 3),
('modcat1@mail.com', 'passmodcat1', 'modcat1', 'Sara', 'Martín', 3),
('modcat2@mail.com', 'passmodcat2', 'modcat2', 'David', 'Vega', 3),
('modext1@mail.com', 'passmodext1', 'modext1', 'Elena', 'Ortega', 3),
('modgal1@mail.com', 'passmodgal1', 'modgal1', 'Jorge', 'García', 3),
('modgal2@mail.com', 'passmodgal2', 'modgal2', 'Marta', 'Gómez', 3),
('modmad1@mail.com', 'passmodmad1', 'modmad1', 'Víctor', 'Sánchez', 3),
('modmur1@mail.com', 'passmodmur1', 'modmur1', 'Patricia', 'Martínez', 3),
('modnav1@mail.com', 'passmodnav1', 'modnav1', 'Roberto', 'Fernández', 3),
('modpv1@mail.com', 'passmodpv1', 'modpv1', 'Eva', 'Gómez', 3),
('modpv2@mail.com', 'passmodpv2', 'modpv2', 'Adrián', 'Sanz', 3),
('modrio1@mail.com', 'passmodrio1', 'modrio1', 'Cristina', 'Torres', 3),
('modval1@mail.com', 'passmodval1', 'modval1', 'Sergio', 'Ibáñez', 3),
('modval2@mail.com', 'passmodval2', 'modval2', 'Nuria', 'Garrido', 3),
('modceu1@mail.com', 'passmodceu1', 'modceu1', 'Óscar', 'Gutiérrez', 3),
('modmel1@mail.com', 'passmodmel1', 'modmel1', 'Raquel', 'Martín', 3);


-- patro
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES 
('patro1@mail.com', 'passpatro1', 'patro1', 'José', 'Martínez', 4),
('patro2@mail.com', 'passpatro2', 'patro2', 'María', 'López', 4),
('patro3@mail.com', 'passpatro3', 'patro3', 'Carlos', 'García', 4),
('patro4@mail.com', 'passpatro4', 'patro4', 'Ana', 'Sánchez', 4),
('patro5@mail.com', 'passpatro5', 'patro5', 'Luis', 'Martín', 4),
('patro6@mail.com', 'passpatro6', 'patro6', 'Elena', 'Pérez', 4),
('patro7@mail.com', 'passpatro7', 'patro7', 'Javier', 'Gómez', 4),
('patro8@mail.com', 'passpatro8', 'patro8', 'Laura', 'Hernández', 4),
('patro9@mail.com', 'passpatro9', 'patro9', 'David', 'Jiménez', 4),
('patro10@mail.com', 'passpatro10', 'patro10', 'Patricia', 'Ruiz', 4),
('patro11@mail.com', 'passpatro11', 'patro11', 'Miguel', 'Fernández', 4),
('patro12@mail.com', 'passpatro12', 'patro12', 'Sara', 'Torres', 4);

-- Usuarios
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu1@mail.com', 'passusu1', 'usu1', 'Antonio', 'Martínez', 5); 
-- 45
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu2@mail.com', 'passusu2', 'usu2', 'María', 'López', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu3@mail.com', 'passusu3', 'usu3', 'Carlos', 'García', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu4@mail.com', 'passusu4', 'usu4', 'Ana', 'Sánchez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu5@mail.com', 'passusu5', 'usu5', 'Luis', 'Martín', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu6@mail.com', 'passusu6', 'usu6', 'Elena', 'Pérez', 5); 
-- 50
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu7@mail.com', 'passusu7', 'usu7', 'Javier', 'Gómez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu8@mail.com', 'passusu8', 'usu8', 'Laura', 'Hernández', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu9@mail.com', 'passusu9', 'usu9', 'David', 'Jiménez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu10@mail.com', 'passusu10', 'usu10', 'Patricia', 'Ruiz', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu11@mail.com', 'passusu11', 'usu11', 'Miguel', 'Fernández', 5); 
-- 55
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu12@mail.com', 'passusu12', 'usu12', 'Sara', 'Torres', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu13@mail.com', 'passusu13', 'usu13', 'Antonio', 'García', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu14@mail.com', 'passusu14', 'usu14', 'María', 'Martínez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu15@mail.com', 'passusu15', 'usu15', 'Carlos', 'López', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu16@mail.com', 'passusu16', 'usu16', 'Ana', 'García', 5); 
-- 60
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu17@mail.com', 'passusu17', 'usu17', 'Luis', 'Sánchez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu18@mail.com', 'passusu18', 'usu18', 'Elena', 'Martín', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu19@mail.com', 'passusu19', 'usu19', 'Javier', 'Pérez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu20@mail.com', 'passusu20', 'usu20', 'Laura', 'Gómez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu21@mail.com', 'passusu21', 'usu21', 'David', 'Hernández', 5); 
-- 65
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu22@mail.com', 'passusu22', 'usu22', 'Patricia', 'Jiménez', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu23@mail.com', 'passusu23', 'usu23', 'Miguel', 'Ruiz', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu24@mail.com', 'passusu24', 'usu24', 'Sara', 'Fernández', 5);
INSERT INTO `usuarios` (`email`, `password`, `nick`, `nombre`, `apellidos`, `rol`) VALUES ('usu25@mail.com', 'passusu25', 'usu25', 'Antonio', 'Torres', 5); 
-- 69


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







