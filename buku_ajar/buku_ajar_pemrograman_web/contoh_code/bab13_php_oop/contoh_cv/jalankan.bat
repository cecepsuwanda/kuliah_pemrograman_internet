@echo off
setlocal

set "HOST=localhost"
set "PORT=8090"
set "URL=http://%HOST%:%PORT%/index.php"

echo ============================================================
echo Server PHP - contoh_cv (Bab 13 PHP OOP MVC)
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

netstat -an | findstr /C:"%HOST%:%PORT% " | findstr LISTENING >nul 2>nul
if not errorlevel 1 (
    echo.
    echo ERROR: Port %PORT% sudah dipakai.
    echo Tutup server lain atau ubah nilai PORT di jalankan.bat.
    echo.
    pause
    exit /b 1
)

pushd "%~dp0"

echo.
echo Folder aplikasi : %CD%
echo CV publik       : %URL%
echo Admin login     : http://%HOST%:%PORT%/admin/login.php
echo.
echo Tekan Ctrl+C untuk menghentikan server.
echo.

start "" "%URL%"
php -S %HOST%:%PORT% router.php
set "EXIT_CODE=%ERRORLEVEL%"

if not "%EXIT_CODE%"=="0" (
    echo.
    echo ERROR: Server gagal dijalankan ^(kode %EXIT_CODE%^).
    echo Pastikan PHP terpasang dan port %PORT% tersedia.
    echo.
    pause
)

popd
endlocal
exit /b %EXIT_CODE%
