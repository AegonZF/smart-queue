@echo off
echo 🚀 Iniciando sincronización inteligente de SmartQueue...
echo.

:: [PASO 0] Verificar si existe el archivo .env
if not exist .env (
    echo 📄 El archivo .env no existe. Creando uno desde la plantilla...
    copy .env.example .env
    echo 🔑 Generando la App Key de seguridad...
    call php artisan key:generate
) else (
    echo ✅ Archivo .env detectado. Manteniendo configuraciones locales.
)

echo.
echo [1/4] 📦 Actualizando dependencias de PHP (Composer)...
call composer install

echo.
echo [2/4] 🗄️ Aplicando nuevas migraciones de Base de Datos...
call php artisan migrate --force

echo.
echo [3/4] ⚡ Actualizando dependencias de Node (NPM)...
call npm install

echo.
echo [4/4] 🎨 Compilando frontend y activando Vite...
npm run dev

pause