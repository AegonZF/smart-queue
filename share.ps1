# Script para compartir SmartQueue con Herd Share

Write-Host "=== Preparando SmartQueue para compartir ===" -ForegroundColor Cyan

# 1. Detener npm run dev si está corriendo
Write-Host "`n1. Deteniendo npm run dev..." -ForegroundColor Yellow
Get-Process -Name node -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep -Seconds 1

# 2. Eliminar archivo hot
Write-Host "2. Eliminando archivo hot..." -ForegroundColor Yellow
if (Test-Path "public/hot") {
    Remove-Item "public/hot" -Force
    Write-Host "   ✓ Archivo hot eliminado" -ForegroundColor Green
}

# 3. Verificar que los assets estén compilados
Write-Host "3. Verificando assets compilados..." -ForegroundColor Yellow
if (!(Test-Path "public/build/manifest.json")) {
    Write-Host "   Compilando assets..." -ForegroundColor Yellow
    npm run build
}

# 4. Limpiar cachés
Write-Host "4. Limpiando cachés..." -ForegroundColor Yellow
php artisan optimize:clear | Out-Null

# 5. Iniciar herd share
Write-Host "`n5. Iniciando Herd Share..." -ForegroundColor Yellow
Write-Host "   IMPORTANTE: Copia la URL pública que aparecerá" -ForegroundColor Cyan
Write-Host "   y actualiza APP_URL y ASSET_URL en el archivo .env`n" -ForegroundColor Cyan

herd share
