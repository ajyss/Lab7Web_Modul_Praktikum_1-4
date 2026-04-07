-- Jalankan ini di phpMyAdmin untuk setup database

-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS lab_ci4;
USE lab_ci4;

-- Hapus tabel lama jika ada
DROP TABLE IF EXISTS artikel;

-- Buat tabel artikel dengan created_at
CREATE TABLE artikel (
    id INT(11) AUTO_INCREMENT,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

-- Tambah data contoh
INSERT INTO artikel (judul, isi, slug, status) VALUES 
('Artikel Pertama', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'artikel-pertama', 1),
('Artikel Kedua', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'artikel-kedua', 1),
('Artikel Ketiga', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.', 'artikel-ketiga', 1);
