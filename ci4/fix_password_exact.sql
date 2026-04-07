-- FIX PASSWORD EXACT MATCH - RUN IN PHPMYADMIN

USE lab_ci4;

-- Cek dulu email yang ada di database
SELECT id, username, useremail FROM user;

-- Update password untuk admin dengan ID 1 (pasti works)
UPDATE user SET userpassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE id = 1;

-- Atau update dengan username (lebih reliable)
UPDATE user SET userpassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE username = 'admin';

-- Verifikasi update
SELECT id, username, useremail, 
       CASE WHEN userpassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
            THEN 'Password Updated' 
            ELSE 'Password Not Updated' 
       END as status 
FROM user WHERE username = 'admin';
