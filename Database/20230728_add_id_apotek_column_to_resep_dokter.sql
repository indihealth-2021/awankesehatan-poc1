ALTER TABLE `resep_dokter` ADD `id_apotek` INT(11); ALTER TABLE `resep_dokter` ADD CONSTRAINT FK_ResepToApotek FOREIGN KEY (`id_apotek`) REFERENCES `master_apotek`(`id`);