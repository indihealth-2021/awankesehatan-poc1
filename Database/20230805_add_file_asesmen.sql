CREATE TABLE file_asesmen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_jadwal_konsultasi INT NOT NULL,
    path_file VARCHAR(255) NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    type_file VARCHAR(50),
    ukuran_file INT
);