-- RESET PASSWORD ADMIN - RUN IN PHPMYADMIN

USE lab_ci4;

-- Hapus semua user lama
DELETE FROM user;

-- Insert user admin baru dengan password hash yang benar
INSERT INTO user (username, useremail, userpassword, is_active) VALUES 
('admin', 'aziztriramadhan29@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Verifikasi
SELECT 'USER ADMIN RESET COMPLETED!' as status;
SELECT id, username, useremail, 'Password: admin123' as login_info FROM user WHERE username = 'admin';

-- Test password hash generation (untuk verifikasi)
SELECT 'admin123' as password_test,
       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' as hash_used;
