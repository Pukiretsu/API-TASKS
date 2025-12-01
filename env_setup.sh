#!/bin/bash
# Script para configurar archivos .env en Linux/macOS (Bash)

echo "Iniciando configuración de archivos de entorno..."

if [ -f "./env.raiz" ]; then
    cp ./env.raiz .env
    echo "Archivo .env de la raíz creado/actualizado correctamente."
else
    echo "ERROR: No se encontró '.env.raiz'. Terminando."
    exit 1
fi

if [ -f "./env.laravel" ]; then
    cp ./env.laravel src/.env
    echo "Archivo .env de Laravel (en src/) creado/actualizado correctamente."
else
    echo "ERROR: No se encontró '.env.laravel'. Terminando."
    exit 1
fi

echo "Configuración de archivos de entorno completada. Por favor, asegúrate de haber ajustado las credenciales en los archivos fuente."