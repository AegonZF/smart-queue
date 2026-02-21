<?php
use function Laravel\Folio\{name};
name('password.request');
?>

<x-layouts.auth.simple>
    <div class="flex flex-col items-center justify-center min-h-full">
        <div class="mb-8 text-center">
            <div class="flex justify-center mb-2">
                 <x-flux::icon.banknotes class="w-12 h-12 text-emerald-500" />
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">NovaBank</h1>
        </div>

        <div class="w-full max-w-[400px] bg-[#001529] p-8 rounded-[2rem] shadow-2xl border border-white/5">
            <h2 class="text-white text-center text-lg font-medium mb-6">Recuperar contraseña</h2>

            <form wire:submit="sendResetLink" class="space-y-6">
                <div>
                    <label class="block text-center text-gray-400 text-sm mb-2">Email para recuperación</label>
                    <input 
                        type="email" 
                        name="email"
                        placeholder="ejemplo@gmail.com"
                        class="w-full bg-[#334155] text-white text-center border-none rounded-xl py-3 focus:ring-2 focus:ring-emerald-500 placeholder-gray-500"
                        required
                    >
                    @error('email')
                        <span class="text-red-500 text-xs mt-2 block text-center">Correo no registrado</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-[#065f46] hover:bg-[#047857] text-white font-semibold py-3 rounded-xl transition duration-200">
                    Enviar
                </button>
            </form>

            <div class="mt-10 text-center">
                <a href="/login" class="text-gray-400 text-sm hover:text-white transition decoration-none">
                    Regresar al inicio de sesión
                </a>
            </div>
        </div>
    </div>
</x-layouts.auth.simple>