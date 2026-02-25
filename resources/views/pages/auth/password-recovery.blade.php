<?php
use function Laravel\Folio\{name};
name('password.request');
?>

<x-layouts::auth.bare>
    <div class="min-h-screen flex flex-col items-center justify-start sm:justify-center bg-[#0C4D8B] z-50 overflow-y-auto py-6 sm:py-10">
        
        <div class="mb-6 sm:mb-10 text-center flex flex-col items-center">
            <img 
                src="{{ asset('images/Logo_1.svg') }}" 
                alt="Logo NovaBank" 
                class="w-[140px] sm:w-[180px] md:w-[220px] h-auto object-contain"
            >
        </div>

        <div class="w-full max-w-[90vw] sm:max-w-[440px] min-h-0 sm:min-h-[540px] flex flex-col justify-between bg-[#072b4e] px-5 py-8 sm:px-10 sm:py-12 rounded-[1.5rem] shadow-2xl border border-white/5 mx-4">
            
            <div class="w-full font-['Source_Sans_3']">
                <h2 class="text-white text-center text-lg font-medium mb-8 font-['Roboto']">Recuperar contraseña</h2>

                <form wire:submit="sendResetLink" class="space-y-6">
                    <div>
                        <label class="block text-center text-gray-300 text-sm mb-3">Email para recuperación</label>
                        <input 
                            type="email" 
                            name="email"
                            placeholder="ejemplo@gmail.com"
                            class="w-full bg-[#3B4B5B] text-white text-center border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-[#02B48A] placeholder-gray-400 outline-none transition-all"
                            required
                        >
                        @error('email')
                            <span class="text-red-500 text-xs mt-2 block text-center">Correo no registrado</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-[#02B48A] hover:bg-[#029672] text-white font-semibold py-3.5 rounded-xl transition duration-200 shadow-lg">
                        Enviar
                    </button>
                </form>
            </div>

            <div class="mt-auto pt-8 text-center">
                <flux:link href="/login" class="text-gray-400 text-sm hover:text-white transition decoration-none">
                    Regresar al inicio de sesión
                </flux:link>
            </div>
        </div>
    </div>
</x-layouts::auth.bare>