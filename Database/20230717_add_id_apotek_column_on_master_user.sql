ALTER TABLE `master_user` ADD COLUMN `id_apotek` INT(11) DEFAULT NULL AFTER `id_fasyankes`; ALTER TABLE `master_user` ADD FOREIGN KEY (`id_apotek`) REFERENCES master_apotek(`id`);