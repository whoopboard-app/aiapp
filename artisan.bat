@echo off
setlocal

REM Laravel Artisan CLI for Windows WAMP
REM This batch file allows you to run artisan commands without PHP in PATH

set PHP_PATH=C:\wamp64\bin\php\php.exe
set ARTISAN_PATH=%~dp0artisan

if not exist "%PHP_PATH%" (
    echo Error: PHP not found at %PHP_PATH%
    echo Please update the PHP_PATH variable in artisan.bat
    exit /b 1
)

"%PHP_PATH%" "%ARTISAN_PATH%" %*
