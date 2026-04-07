@echo off
echo ========================================
echo    SETUP DATABASE CI4 - OTOMATIS
echo ========================================
echo.

cd /d c:\xampp\mysql\bin

echo.
echo [1/4] Menghubungkan ke MySQL...
mysql -u root --password= -e "CREATE DATABASE IF NOT EXISTS lab_ci4;" 2>nul
if errorlevel 1 (
    echo ERROR: Tidak bisa connect ke MySQL. Pastikan XAMPP MySQL running!
    pause
    exit
)

echo.
echo [2/4] Membuat tabel user dan artikel...
mysql -u root --password= lab_ci4 < "c:\xampp\htdocs\lab11_ci\ci4\complete_setup.sql" 2>nul
if errorlevel 1 (
    echo ERROR: Gagal membuat tabel. Cek file SQL!
    pause
    exit
)

echo.
echo [3/4] Verifikasi tabel...
mysql -u root --password= -e "USE lab_ci4; SHOW TABLES;" 2>nul

echo.
echo [4/4] Setup selesai!
echo.
echo Database Status:
mysql -u root --password= -e "USE lab_ci4; SELECT 'Users: ' as info, COUNT(*) as count FROM user UNION SELECT 'Artikel: ' as info, COUNT(*) as count FROM artikel;" 2>nul

echo.
echo ========================================
echo    LOGIN INFO:
echo    Email: aziztriramadhan29@gmail.com
echo    Password: admin123
echo ========================================
echo.
echo Tekan sembarang tombol untuk membuka browser...
pause > nul

start http://localhost/lab11_ci/ci4/user/login

echo.
echo Setup completed! Check browser untuk login.
