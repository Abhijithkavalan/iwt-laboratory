@echo off
title IWT Laboratory - Master Web Server Launcher
color 0b

echo =====================================================================
echo           INTERNET & WEB TECHNOLOGIES (IWT) LABORATORY
echo               Master Web Server & Portal Launcher
echo =====================================================================
echo.

cd /d "%~dp0"

:: Check if PHP exists in XAMPP
if exist "C:\xampp\php\php.exe" (
    set "PHP_CMD=C:\xampp\php\php.exe"
    goto START_PHP
)

:: Check if PHP is in PATH
where php >nul 2>&1
if %errorlevel% equ 0 (
    set "PHP_CMD=php"
    goto START_PHP
)

:: Check if Python is in PATH
where python >nul 2>&1
if %errorlevel% equ 0 (
    goto START_PYTHON
)

:: Fallback: Open index.html directly
echo [!] Neither PHP nor Python was found.
echo [*] Opening IWT Master Portal directly in your default web browser...
start "" "%~dp0index.html"
goto END

:START_PHP
echo [+] PHP runtime detected: %PHP_CMD%
echo [+] Starting local HTTP server at http://127.0.0.1:8000 ...
echo [+] Serving directory: %~dp0
echo.
echo [*] Opening http://127.0.0.1:8000 in your web browser...
start http://127.0.0.1:8000/

echo.
echo =====================================================================
echo  SERVER ACTIVE! Do not close this terminal while viewing the website.
echo  Press Ctrl+C to stop the server when finished.
echo =====================================================================
echo.
"%PHP_CMD%" -S 127.0.0.1:8000 -t "%~dp0"
goto END

:START_PYTHON
echo [+] Python runtime detected.
echo [+] Starting local static server on port 8000...
echo [*] Opening http://127.0.0.1:8000 in your web browser...
start http://127.0.0.1:8000/
python -m http.server 8000

:END
pause