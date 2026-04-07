-- Database setup untuk lab_ci4
CREATE DATABASE IF NOT EXISTS lab_ci4;
USE lab_ci4;

-- Hapus tabel jika ada untuk fresh install
DROP TABLE IF EXISTS artikel;

-- Buat tabel artikel
CREATE TABLE artikel (
    id INT(11) auto_increment,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);

-- Tambah data contoh
INSERT INTO artikel (judul, isi, slug, status) VALUES 
('Artikel Pertama', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'artikel-pertama', 1),
('Artikel Kedua', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.', 'artikel-kedua', 1),
('Artikel Ketiga', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.', 'artikel-ketiga', 1),
('Artikel Keempat', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.', 'artikel-keempat', 1),
('Artikel Kelima', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias.', 'artikel-kelima', 1);
