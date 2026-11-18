# IWT Laboratory - Master Web Server Launcher (PowerShell)
$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $ScriptDir

Write-Host "=====================================================================" -ForegroundColor Cyan
Write-Host "          INTERNET & WEB TECHNOLOGIES (IWT) LABORATORY" -ForegroundColor Cyan
Write-Host "              Master Web Server & Portal Launcher" -ForegroundColor Cyan
Write-Host "=====================================================================" -ForegroundColor Cyan
Write-Host ""

$PhpPath = $null
if (Test-Path "C:\xampp\php\php.exe") {
    $PhpPath = "C:\xampp\php\php.exe"
} elseif (Get-Command php -ErrorAction SilentlyContinue) {
    $PhpPath = "php"
}

if ($PhpPath) {
    Write-Host "[+] PHP runtime found: $PhpPath" -ForegroundColor Green
    Write-Host "[+] Starting web server on http://127.0.0.1:8000 ..." -ForegroundColor Green
    Start-Process "http://127.0.0.1:8000/"
    & $PhpPath -S 127.0.0.1:8000 -t $ScriptDir
} elseif (Get-Command python -ErrorAction SilentlyContinue) {
    Write-Host "[+] Starting Python web server on http://127.0.0.1:8000 ..." -ForegroundColor Yellow
    Start-Process "http://127.0.0.1:8000/"
    python -m http.server 8000
} else {
    Write-Host "[*] Opening index.html directly in default browser..." -ForegroundColor Cyan
    Start-Process "$ScriptDir\index.html"
}