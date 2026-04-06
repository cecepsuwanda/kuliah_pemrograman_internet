@echo off
REM Double-click: buka cmd /k agar jendela tidak hilang sebelum pesan terbaca.
if /i not "%~1"==":run" (
    "%ComSpec%" /k "%~f0" :run
    exit /b 0
)

chcp 65001 >nul
setlocal enabledelayedexpansion

cd /d "%~dp0"

set "OUTPUT_DIR=%~dp0..\output"
if not exist "%OUTPUT_DIR%" mkdir "%OUTPUT_DIR%"

where pdflatex >nul 2>&1
if errorlevel 1 (
    echo [ERROR] pdflatex tidak ada di PATH. Pasang MiKTeX/TeX Live dan coba lagi.
    goto :finish
)

set "COUNT=0"
for %%F in (*.tex) do set /a COUNT+=1
if !COUNT! equ 0 (
    echo Tidak ada file .tex di folder ini:
    echo %~dp0
    goto :finish
)

echo ==========================================
echo Kompilasi semua file LaTeX di ppt\
echo Folder kerja: %~dp0
echo Output PDF/log: %OUTPUT_DIR%
echo ==========================================

set "OK=0"
set "FAIL=0"

for %%F in (*.tex) do call :compile_one "%%F"

echo.
echo ==========================================
echo Ringkasan: berhasil !OK!, gagal !FAIL!
echo ==========================================

goto :finish

:compile_one
set "TEXFILE=%~nx1"
set "BASENAME=%~n1"

echo.
echo ------------------------------------------
echo !TEXFILE!
echo ------------------------------------------

echo [1/2] pdflatex lulus pertama...
pdflatex -interaction=nonstopmode "!TEXFILE!" >nul 2>&1
if errorlevel 1 (
    echo [GAGAL] Cek !BASENAME!.log di folder ppt.
    set /a FAIL+=1
    goto :eof
)

echo [2/2] pdflatex lulus kedua ^(TOC/referensi^)...
pdflatex -interaction=nonstopmode "!TEXFILE!" >nul 2>&1
if errorlevel 1 (
    echo [GAGAL] Cek !BASENAME!.log
    set /a FAIL+=1
    goto :eof
)

if exist "!BASENAME!.log" move /y "!BASENAME!.log" "%OUTPUT_DIR%\" >nul 2>&1

REM Artefak sementara umum (LaTeX + Beamer); .log sudah dipindah
for %%E in (aux bbl blg bcf fdb_latexmk fls lof lol lot nav out run.xml snm synctex.gz toc vrb) do (
    if exist "!BASENAME!.%%E" del "!BASENAME!.%%E" 2>nul
)

if exist "!BASENAME!.pdf" (
    move /y "!BASENAME!.pdf" "%OUTPUT_DIR%\" >nul
    echo OK: %OUTPUT_DIR%\!BASENAME!.pdf
    set /a OK+=1
) else (
    echo [GAGAL] PDF tidak terbentuk: !BASENAME!.pdf
    set /a FAIL+=1
)
goto :eof

:finish
echo.
echo Tekan tombol apa saja untuk menutup jendela ini...
pause >nul
if /i "%~1"==":run" exit
