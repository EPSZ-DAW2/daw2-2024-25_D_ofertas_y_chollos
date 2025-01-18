ALTER TABLE `ofertas` ADD COLUMN `patrocinador_id` INT NULL AFTER `proveedor_id`;

ALTER TABLE `ofertas` ADD CONSTRAINT `fk_ofertas_patrocinador_id` FOREIGN KEY (`patrocinador_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `anuncios` ADD COLUMN `estado` VARCHAR(20) NOT NULL DEFAULT 'visible' AFTER `oferta_id`;
