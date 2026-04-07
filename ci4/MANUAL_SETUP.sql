-- SETUP DATABASE MANUAL - LANGKAH PER LANGKAH
-- Copy dan paste ini di phpMyAdmin

-- Step 1: Buat database
CREATE DATABASE IF NOT EXISTS lab_ci4;
USE lab_ci4;

-- Step 2: Hapus tabel lama (jika ada)
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS artikel;

-- Step 3: Buat tabel user
CREATE TABLE user (
    id INT(11) AUTO_INCREMENT,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200) UNIQUE,
    userpassword VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    PRIMARY KEY(id)
);

-- Step 4: Buat tabel artikel
CREATE TABLE artikel (
    id INT(11) AUTO_INCREMENT,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);

-- Step 5: Insert user admin (email: aziztriramadhan29@gmail.com, password: admin123)
INSERT INTO user (username, useremail, userpassword, is_active) VALUES 
('admin', 'aziztriramadhan29@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('editor', 'editor@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('user', 'user@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Step 6: Insert artikel sample
INSERT INTO artikel (judul, isi, slug, status) VALUES 
('Artikel Pertama', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'artikel-pertama', 1),
('Artikel Kedua', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'artikel-kedua', 1),
('Artikel Ketiga', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.', 'artikel-ketiga', 1);

-- Step 7: Verifikasi
SELECT 'DATABASE SETUP COMPLETED!' as status;
SELECT COUNT(*) as total_users FROM user;
SELECT COUNT(*) as total_artikel FROM artikel;
SELECT username, useremail, 'Password: admin123' as login_info FROM user WHERE useremail = 'aziztriramadhan29@gmail.com';
