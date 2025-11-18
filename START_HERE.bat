@echo off
echo.
echo ========================================
echo   InsightHQ Development Environment
echo ========================================
echo.
echo Starting Laravel + Vite servers...
echo.
echo You need TWO terminal windows:
echo.
echo Terminal 1: Laravel Server (Port 8000)
echo Terminal 2: Vite Dev Server (Hot Reload)
echo.
echo ========================================
echo.

start "Laravel Server" cmd /k "cd /d %~dp0 && serve.bat"
timeout /t 2 /nobreak > nul
start "Vite Dev Server" cmd /k "cd /d %~dp0 && dev.bat"

echo.
echo Both servers starting...
echo.
echo Visit: http://127.0.0.1:8000/signup
echo.
pause
