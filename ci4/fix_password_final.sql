-- FIX PASSWORD - RUN THIS SQL IN PHPMYADMIN

USE lab_ci4;

-- Update password for aziztriramadhan29@gmail.com
UPDATE user SET userpassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE useremail = 'aziztriramadhan29@gmail.com';

-- Also update admin@email.com (if still exists)
UPDATE user SET userpassword = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' WHERE useremail = 'admin@email.com';

-- Verify users
SELECT username, useremail, 'Password: admin123' as password_info FROM user;

-- Test password verification (this should show 1 if hash is correct)
SELECT 'admin123' as test_password, 
       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' as stored_hash,
       (SELECT CASE WHEN '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' = password_hash('admin123', PASSWORD_DEFAULT) THEN 1 ELSE 0 END) as hash_match;
