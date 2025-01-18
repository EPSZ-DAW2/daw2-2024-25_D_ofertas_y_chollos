USE `daw_proyectod`;

-- INSERCIÓN DE DATOS INICIALES PARA LA TABLA `anuncio`



INSERT INTO `anuncios` (`titulo`, `descripcion`, `precio`, `fecha`, `oferta_id`)
SELECT 
    CONCAT('Anuncio ', `titulo`),
    CONCAT('Descripcion del anuncio de la ', `titulo`),
    `precio_actual`,
    `fecha_fin`,
    `id`
FROM `ofertas`
WHERE `anuncio_destacado` = true;