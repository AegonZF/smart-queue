<?php
use function Laravel\Folio\name;
name('login');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartQueue - Iniciar Sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fdfcfb] min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-gray-100 p-10">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-[#001d3d] rounded-2xl mb-4 shadow-xl">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-black text-[#001d3d] tracking-tight">SmartQueue</h1>
            <p class="text-gray-400 mt-2 font-medium">Gestión de turnos inteligente</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-bold text-[#001d3d] uppercase tracking-widest">Correo</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#003566] focus:bg-white text-[#001d3d] transition-all outline-none" 
                    placeholder="ejemplo@correo.com">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-bold text-[#001d3d] uppercase tracking-widest">Contraseña</label>
                <input type="password" name="password" required 
                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-2 border-transparent focus:border-[#003566] focus:bg-white text-[#001d3d] transition-all outline-none" 
                    placeholder="••••••••">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-[#001d3d] hover:bg-[#003566] text-white font-black py-4 rounded-2xl shadow-xl transition-all transform hover:-translate-y-1 active:scale-95">
                ENTRAR
            </button>

            <div class="text-center mt-6">
                <a href="{{ route('register') }}" class="text-[#003566] font-bold text-sm hover:underline">
                    ¿No tienes cuenta? Regístrate
                </a>
            </div>
        </form>
    </div>
</body>
</html>