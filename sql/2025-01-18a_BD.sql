ALTER TABLE `ofertas` ADD COLUMN `patrocinador_id` INT NULL AFTER `proveedor_id`;

ALTER TABLE `ofertas` ADD CONSTRAINT `fk_ofertas_patrocinador_id` FOREIGN KEY (`patrocinador_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;