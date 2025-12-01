@echo off
REM Script para configurar archivos .env en Windows (Command Prompt)

echo Iniciando configuracion de archivos de entorno...

IF EXIST ".\.env.raiz" (
    copy .\.env.raiz .env
    echo.
    echo Archivo .env de la raiz creado/actualizado correctamente.
) ELSE (
    echo.
    echo ERROR: No se encontro '.\.env.raiz'. Terminando.
    exit /b 1
)

IF EXIST ".\.env.laravel" (
    copy .\.env.laravel src\.env
    echo.
    echo Archivo .env de Laravel (en src/) creado/actualizado correctamente.
) ELSE (
    echo.
    echo ERROR: No se encontro '.\.env.laravel'. Terminando.
    exit /b 1
)

echo.
echo Configuracion de archivos de entorno completada.