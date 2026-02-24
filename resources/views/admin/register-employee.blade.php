<x-layouts::auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
        
        /* Ocultar el ojo nativo de los navegadores */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
        input[type="password"]::-webkit-reveal,
        input[type="password"]::-webkit-clear-button {
            display: none !important;
        }
    </style>

    <div class="fixed inset-0 flex flex-col items-center justify-center bg-[#041C32] z-50 font-['Source_Sans_3'] overflow-y-auto py-8">
        
        {{-- LOGO --}}
        <div class="mb-6 text-center flex flex-col items-center shrink-0">
            <img src="{{ asset('images/Logo_1.svg') }}" alt="Logo NovaBank" class="w-[220px] h-auto object-contain">
        </div>

        {{-- TARJETA PRINCIPAL --}}
        <div class="w-full max-w-[440px] flex flex-col bg-[#061421] px-10 py-10 rounded-[1.5rem] shadow-2xl border border-white/5 shrink-0">
            
            {{-- Títulos --}}
            <div class="w-full text-center mb-8">
                <h2 class="text-white !text-[1.3rem] font-semibold tracking-wide">Crear cuenta</h2>
                <h3 class="text-white !text-[1.2rem] font-normal tracking-wide mt-1">Empleado</h3>
            </div>

            <form method="POST" action="#" class="flex flex-col gap-4">
                @csrf

                {{-- 1. Nombre Completo --}}
                <div class="flex flex-col">
                    <input type="text" name="name" placeholder="Nombre Completo" required
                        class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-6 focus:ring-2 focus:ring-[#00705A] outline-none !text-[15px] placeholder:!text-[15px] transition-all">
                </div>

                {{-- 2. Correo --}}
                <div class="flex flex-col">
                    <input type="email" name="email" placeholder="Correo" required
                        class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-6 focus:ring-2 focus:ring-[#00705A] outline-none !text-[15px] placeholder:!text-[15px] transition-all">
                </div>

                {{-- 3. Contraseña --}}
                <div class="flex flex-col" x-data="{ show: false }">
                    <div class="relative w-full">
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Contraseña" required
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-6 pr-12 focus:ring-2 focus:ring-[#00705A] outline-none !text-[15px] placeholder:!text-[15px] transition-all">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#94A3B8] hover:text-white focus:outline-none">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- 4. Confirmar Contraseña --}}
                <div class="flex flex-col" x-data="{ show: false }">
                    <div class="relative w-full">
                        <input :type="show ? 'text' : 'password'" name="password_confirmation" placeholder="Confirmar contraseña" required
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-2.5 px-6 pr-12 focus:ring-2 focus:ring-[#00705A] outline-none !text-[15px] placeholder:!text-[15px] transition-all">
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#94A3B8] hover:text-white focus:outline-none">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Botón Registrar --}}
                <button type="submit" class="w-full bg-[#00705A] hover:bg-[#005B49] text-white font-medium py-3 rounded-full mt-3 transition-all shadow-lg active:scale-95 !text-[16px]">
                    Registrar Empleado
                </button>

                {{-- Botón Regresar --}}
                <a href="/admin/preview" class="w-1/2 mx-auto text-center bg-[#00705A] hover:bg-[#005B49] text-white font-medium py-2 rounded-full mt-1 transition-all shadow-lg active:scale-95 !text-[15px]">
                    Regresar
                </a>
            </form>
        </div>
    </div>
</x-layouts::auth>