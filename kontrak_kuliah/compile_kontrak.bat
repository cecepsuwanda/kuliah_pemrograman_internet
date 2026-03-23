@echo off
chcp 65001 >nul
setlocal

cd /d "%~dp0"
set "OUTPUT_DIR=%~dp0..\output"
if not exist "%OUTPUT_DIR%" mkdir "%OUTPUT_DIR%"
set TEXFILE=Kontrak_Kuliah.tex
set BASENAME=Kontrak_Kuliah

echo [1/3] Kompilasi pertama...
pdflatex -interaction=nonstopmode "%TEXFILE%" >nul 2>&1

echo [2/3] Kompilasi kedua (untuk referensi)...
pdflatex -interaction=nonstopmode "%TEXFILE%" >nul 2>&1

echo [3/3] Membersihkan file sementara (kecuali .log, .out, dan .pdf)...

if exist "%BASENAME%.aux" del "%BASENAME%.aux"
if exist "%BASENAME%.toc" del "%BASENAME%.toc"
if exist "%BASENAME%.lof" del "%BASENAME%.lof"
if exist "%BASENAME%.lot" del "%BASENAME%.lot"
if exist "%BASENAME%.fls" del "%BASENAME%.fls"
if exist "%BASENAME%.fdb_latexmk" del "%BASENAME%.fdb_latexmk"
if exist "%BASENAME%.synctex.gz" del "%BASENAME%.synctex.gz"
if exist "%BASENAME%.nav" del "%BASENAME%.nav"
if exist "%BASENAME%.snm" del "%BASENAME%.snm"

echo [4/3] Memindahkan file hasil ke folder output...
if exist "%BASENAME%.pdf" move /y "%BASENAME%.pdf" "%OUTPUT_DIR%\"
if exist "%BASENAME%.log" move /y "%BASENAME%.log" "%OUTPUT_DIR%\"
if exist "%BASENAME%.out" move /y "%BASENAME%.out" "%OUTPUT_DIR%\"

echo.
echo Selesai. Hasil: %BASENAME%.pdf, %BASENAME%.log (dan %BASENAME%.out untuk bookmark) telah dipindah ke folder output.
pause
