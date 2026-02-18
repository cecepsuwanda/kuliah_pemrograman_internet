@echo off
setlocal

set "ROOT=%~dp0"
pushd "%ROOT%"

echo ============================================================
echo Menghapus file hasil kompilasi LaTeX di seluruh codebase...
echo (root + semua subfolder)
echo ============================================================
echo.

REM LaTeX auxiliary (sesuai .gitignore)
for %%E in (aux bbl bcf blg fdb_latexmk fls lof log lol lot out synctex.gz toc) do (
    del /s /q "*.%%E" 2>nul
)

REM Glossary/Index
for %%E in (acn acr alg glg glo gls idx ilg ind ist xdy) do (
    del /s /q "*.%%E" 2>nul
)

REM Beamer
for %%E in (nav snm vrb) do (
    del /s /q "*.%%E" 2>nul
)

REM XML (latexmk)
del /s /q "*.run.xml" 2>nul

REM PDF hasil kompilasi
del /s /q "*.pdf" 2>nul

REM Folder output (jika ada)
if exist "output" (
    echo Menghapus folder output...
    rmdir /s /q "output"
)
if exist "buku_ajar\output" (
    rmdir /s /q "buku_ajar\output"
)
if exist "buku_ajar_pemrograman_internet\output" (
    rmdir /s /q "buku_ajar_pemrograman_internet\output"
)

popd

echo.
echo Pembersihan selesai!
pause
