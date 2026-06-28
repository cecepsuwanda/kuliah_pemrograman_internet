@echo off
setlocal

set "APP_DIR=%~dp0"
set "HOST=localhost"
set "PORT=8080"
set "URL=http://%HOST%:%PORT%/index.php"

echo ============================================================
echo Server PHP - contoh_cv (Bab 14 MySQL)
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
echo CV publik       : %URL%
echo Wizard instal   : http://%HOST%:%PORT%/install.php
echo Admin login     : http://%HOST%:%PORT%/admin/login.php
echo.
echo Jika belum terinstal, buka install.php di browser.
echo Tekan Ctrl+C untuk menghentikan server.
echo.

pushd "%APP_DIR%"
start "" "%URL%"
php -S %HOST%:%PORT% -t "%APP_DIR%"
set "EXIT_CODE=%ERRORLEVEL%"
popd

endlocal
exit /b %EXIT_CODE%
