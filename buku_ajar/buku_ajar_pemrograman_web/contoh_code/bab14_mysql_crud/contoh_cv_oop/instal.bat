@echo off
setlocal

set "APP_DIR=%~dp0"
set "HOST=localhost"
set "PORT=8090"
set "URL=http://%HOST%:%PORT%/install.php"

echo ============================================================
echo Instalasi browser - contoh_cv_oop (Bab 14 MySQL MVC)
echo ============================================================

where php >nul 2>nul
if errorlevel 1 (
    echo.
    echo ERROR: PHP tidak ditemukan di PATH.
    echo Pasang PHP dari https://windows.php.net/download/ lalu coba lagi.
    echo.
    pause
    exit /b 1
)

echo.
echo Folder aplikasi : %APP_DIR%
echo Wizard instal   : %URL%
echo.
echo Pastikan MySQL/XAMPP sudah berjalan.
echo Tekan Ctrl+C untuk menghentikan server.
echo.

pushd "%APP_DIR%"
start "" "%URL%"
php -S %HOST%:%PORT% router.php
set "EXIT_CODE=%ERRORLEVEL%"
popd

endlocal
exit /b %EXIT_CODE%
