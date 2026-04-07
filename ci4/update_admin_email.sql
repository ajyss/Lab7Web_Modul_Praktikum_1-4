-- UPDATE ADMIN EMAIL - AZIZ TRI RAMADHAN

USE lab_ci4;

-- Update email admin yang sudah ada
UPDATE user SET useremail = 'aziztriramadhan29@gmail.com' WHERE username = 'admin';

-- Atau hapus dan buat baru
DELETE FROM user WHERE useremail = 'aziztriramadhan29@gmail.com';

INSERT INTO user (username, useremail, userpassword, is_active) VALUES 
('admin', 'aziztriramadhan29@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Verifikasi
SELECT 'ADMIN LOGIN INFO:' as info;
SELECT username, useremail, 'Password: admin123' as password FROM user WHERE useremail = 'aziztriramadhan29@gmail.com';
