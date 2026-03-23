@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

cd /d "%~dp0"

set "OUTPUT_DIR=%~dp0..\output"
if not exist "%OUTPUT_DIR%" mkdir "%OUTPUT_DIR%"

echo ==========================================
echo Kompilasi Semua Presentasi (PPT) Bab
echo ==========================================

for %%F in (Bab*.tex) do (
    set "TEXFILE=%%F"
    set "BASENAME=%%~nF"
    
    echo.
    echo ------------------------------------------
    echo Mengkompilasi !TEXFILE!
    echo ------------------------------------------
    
    echo [1/3] Kompilasi pertama...
    pdflatex -interaction=nonstopmode "!TEXFILE!" >nul 2>&1
    
    echo [2/3] Kompilasi kedua (untuk referensi)...
    pdflatex -interaction=nonstopmode "!TEXFILE!" >nul 2>&1
    
    echo [3/3] Membersihkan file sementara...
    if exist "!BASENAME!.aux" del "!BASENAME!.aux"
    if exist "!BASENAME!.toc" del "!BASENAME!.toc"
    if exist "!BASENAME!.lof" del "!BASENAME!.lof"
    if exist "!BASENAME!.lot" del "!BASENAME!.lot"
    if exist "!BASENAME!.fls" del "!BASENAME!.fls"
    if exist "!BASENAME!.fdb_latexmk" del "!BASENAME!.fdb_latexmk"
    if exist "!BASENAME!.synctex.gz" del "!BASENAME!.synctex.gz"
    if exist "!BASENAME!.nav" del "!BASENAME!.nav"
    if exist "!BASENAME!.snm" del "!BASENAME!.snm"
    if exist "!BASENAME!.out" del "!BASENAME!.out"
    
    echo [4/3] Memindahkan file PDF dan log ke folder output...
    if exist "!BASENAME!.pdf" move /y "!BASENAME!.pdf" "%OUTPUT_DIR%\"
    if exist "!BASENAME!.log" move /y "!BASENAME!.log" "%OUTPUT_DIR%\"
    
    echo Selesai: !BASENAME!.pdf
)

echo.
echo ==========================================
echo Semua file selesai dikompilasi.
echo ==========================================
pause
