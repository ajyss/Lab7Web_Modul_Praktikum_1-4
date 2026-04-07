-- Setup tabel user untuk modul login
USE lab_ci4;

-- Buat tabel user
CREATE TABLE IF NOT EXISTS user (
    id INT(11) auto_increment,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200) UNIQUE,
    userpassword VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    PRIMARY KEY(id)
);

-- Tambah user default (password: admin123)
INSERT INTO user (username, useremail, userpassword, is_active) VALUES 
('admin', 'admin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('editor', 'editor@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('user', 'user@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1)
ON DUPLICATE KEY UPDATE userpassword = userpassword;
