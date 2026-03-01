@echo off
chcp 65001 >nul
setlocal

set TEXFILE=silabus_pemrograman_web.tex
set BASENAME=silabus_pemrograman_web

echo [1/3] Kompilasi pertama...
pdflatex -interaction=nonstopmode "%TEXFILE%" >nul 2>&1

echo [2/3] Kompilasi kedua (untuk referensi)...
pdflatex -interaction=nonstopmode "%TEXFILE%" >nul 2>&1

echo [3/3] Membersihkan file sementara (kecuali .log dan .pdf)...

if exist "%BASENAME%.aux" del "%BASENAME%.aux"
if exist "%BASENAME%.out" del "%BASENAME%.out"
if exist "%BASENAME%.toc" del "%BASENAME%.toc"
if exist "%BASENAME%.lof" del "%BASENAME%.lof"
if exist "%BASENAME%.lot" del "%BASENAME%.lot"
if exist "%BASENAME%.fls" del "%BASENAME%.fls"
if exist "%BASENAME%.fdb_latexmk" del "%BASENAME%.fdb_latexmk"
if exist "%BASENAME%.synctex.gz" del "%BASENAME%.synctex.gz"

echo.
echo Selesai. Hasil: %BASENAME%.pdf dan %BASENAME%.log
pause
