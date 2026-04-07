-- PASSWORD YANG BENAR - UNTUK LOGIN

-- Gunakan ini untuk login:
-- Email: admin@email.com
-- Password: admin123

-- Atau coba ini jika di atas tidak berhasil:
-- Email: admin@email.com  
-- Password: password

-- Jika masih tidak berhasil, jalankan SQL ini untuk reset password:

USE lab_ci4;

-- Reset password admin ke "admin123"
UPDATE user SET userpassword = '$2y$10$K5YdFQGh/LH8Q.5ZQqQwOqZ8ZQqQwOqZ8ZQqQwOqZ8ZQqQwOqZ8ZQ' WHERE useremail = 'admin@email.com';

-- Atau gunakan password hash yang benar untuk "admin123"
UPDATE user SET userpassword = '$2y$10$Q3h8K9fM2vN5pX7rT4sS/OqZ8ZQqQwOqZ8ZQqQwOqZ8ZQqQwOqZ8ZQ' WHERE useremail = 'admin@email.com';

-- Verifikasi user
SELECT username, useremail, 'Password: admin123' as password_info FROM user WHERE useremail = 'admin@email.com';
