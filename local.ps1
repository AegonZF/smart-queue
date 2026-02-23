# Script para volver a desarrollo local

Write-Host "=== Configurando SmartQueue para desarrollo local ===" -ForegroundColor Cyan

# 1. Verificar .env
Write-Host "`n1. Verificando configuración..." -ForegroundColor Yellow
$appUrl = Get-Content .env | Select-String "^APP_URL=" | Select-Object -First 1
if ($appUrl -match "localhost") {
    Write-Host "   ✓ Ya estás en modo local" -ForegroundColor Green
} else {
    Write-Host "   ⚠ Recuerda cambiar APP_URL a http://localhost:8000 en .env" -ForegroundColor Red
}

# 2. Limpiar cachés
Write-Host "2. Limpiando cachés..." -ForegroundColor Yellow
php artisan config:clear | Out-Null
php artisan view:clear | Out-Null
Write-Host "   ✓ Cachés limpiados" -ForegroundColor Green

Write-Host "`n✓ Listo para desarrollo local" -ForegroundColor Green
Write-Host "Puedes ejecutar: npm run dev" -ForegroundColor Cyan
