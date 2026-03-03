#!/usr/bin/env bash
set -e

HERD="/Users/marios/Library/Application Support/Herd/bin/herd"

echo "=== Preparando SmartQueue para compartir ==="

# 1. Matar procesos node/vite que puedan tener el archivo hot activo
echo ""
echo "1. Deteniendo procesos npm/vite..."
pkill -f "vite" 2>/dev/null || true
pkill -f "npm run dev" 2>/dev/null || true
sleep 1

# 2. Eliminar archivo hot
echo "2. Eliminando archivo hot..."
if [ -f "public/hot" ]; then
    rm -f public/hot
    echo "   ✓ Archivo hot eliminado"
fi

# 3. Verificar que los assets estén compilados
echo "3. Verificando assets compilados..."
if [ ! -f "public/build/manifest.json" ]; then
    echo "   Compilando assets..."
    npm run build
else
    echo "   ✓ Assets ya compilados"
fi

# 4. Limpiar cachés
echo "4. Limpiando cachés..."
php artisan optimize:clear

# 5. Iniciar herd share
echo ""
echo "5. Iniciando Herd Share..."
echo "   IMPORTANTE: Copia la URL pública que aparecerá"
echo "   y actualiza APP_URL y ASSET_URL en el archivo .env"
echo ""

"$HERD" share
