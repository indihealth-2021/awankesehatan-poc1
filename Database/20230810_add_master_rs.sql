CREATE TABLE `master_rs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(250) NOT NULL,
  `direktur` VARCHAR(250) NOT NULL,
  `telp_fax` VARCHAR(100) NOT NULL,
  `alamat_provinsi` VARCHAR(50) NOT NULL,
  `alamat_kota` VARCHAR(50) NOT NULL,
  `alamat_kelurahan` VARCHAR(50) NOT NULL,
  `alamat_kecamatan` VARCHAR(50) NOT NULL,
  `alamat_detail` TEXT NOT NULL,
  `kode_pos` VARCHAR(20) NOT NULL,
  `lat` VARCHAR(50) DEFAULT NULL,
  `lng` VARCHAR(50) DEFAULT NULL,
  `logo` TEXT NOT NULL,
  PRIMARY KEY (`id`)
)