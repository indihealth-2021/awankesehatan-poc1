CREATE TABLE data_penunjang (
    id int(11) NOT NULL,
    id_jadwal_konsultasi int(11) NOT NULL,
    planning TEXT DEFAULT NULL,
    pemeriksaan_penunjang_laboratorium json DEFAULT NULL,
    pemeriksaan_penunjang_radiologi json DEFAULT NULL,
    kesimpulan TEXT DEFAULT NULL
);

ALTER TABLE data_penunjang
ADD PRIMARY KEY (id);

ALTER TABLE data_penunjang
ADD FOREIGN KEY (id_jadwal_konsultasi) REFERENCES jadwal_konsultasi(id);

ALTER TABLE `data_penunjang` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE biaya_pengiriman_obat
ADD harga_obat int(11);
