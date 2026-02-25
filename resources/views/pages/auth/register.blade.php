<x-layouts::auth.bare>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;500;600;700&display=swap');
        
        /* Ocultar el ojo nativo de Edge e Internet Explorer */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
        /* Ocultar el ojo nativo de navegadores Webkit (Chrome, Safari, Edge moderno) */
        input[type="password"]::-webkit-reveal,
        input[type="password"]::-webkit-clear-button {
            display: none !important;
        }
    </style>

    <div class="min-h-screen flex flex-col items-center justify-start sm:justify-center bg-[#0C4D8B] z-50 font-['Source_Sans_3'] overflow-y-auto py-6 sm:py-10">
        
        <div class="mb-6 sm:mb-10 text-center flex flex-col items-center">
            <img src="{{ asset('images/Logo_1.svg') }}" alt="Logo NovaBank" class="w-[140px] sm:w-[180px] md:w-[220px] h-auto">
        </div>

        <div class="w-full max-w-[90vw] sm:max-w-[440px] min-h-0 sm:min-h-[540px] flex flex-col justify-between bg-[#072b4e] px-5 py-8 sm:px-10 sm:py-12 rounded-[1.5rem] shadow-2xl border border-white/5 mx-4">
            
            <div class="w-full">
                <h2 class="text-white text-center !text-[1.2rem] sm:!text-[1.5rem] font-semibold mb-5 sm:mb-8 tracking-wide">
                    Crear cuenta
                </h2>

                <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
                    @csrf

                    {{-- 1. Nombre --}}
                    <div class="flex flex-col">
                        <input type="text" name="name" placeholder="Nombre completo" required value="{{ old('name') }}"
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-3 px-6 focus:ring-2 focus:ring-[#02B48A] outline-none !text-[16px] placeholder:!text-[16px] transition-all">
                        
                        @error('name')
                            <p class="text-[#ef4444] !text-[12px] text-center mt-2 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- 2. Correo --}}
                    <div class="flex flex-col">
                        <input type="email" name="email" placeholder="Correo electrónico" required value="{{ old('email') }}"
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-3 px-6 focus:ring-2 focus:ring-[#02B48A] outline-none !text-[16px] placeholder:!text-[16px] transition-all">
                        
                        @error('email')
                            <p class="text-[#ef4444] !text-[12px] text-center mt-2 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- 2. Contraseña (Con botón personalizado) --}}
                    {{-- Usamos x-data para manejar el estado de mostrar/ocultar con Alpine.js --}}
                    <div class="flex flex-col" x-data="{ show: false }">
                        <div class="relative w-full">
                            {{-- Cambiamos dinámicamente el tipo de input entre password y text --}}
                            <input :type="show ? 'text' : 'password'" name="password" placeholder="Contraseña" required
                                class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-3 px-6 pr-12 focus:ring-2 focus:ring-[#02B48A] outline-none !text-[16px] placeholder:!text-[16px] transition-all">
                            
                            {{-- Botón Ojo Absoluto --}}
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[#94A3B8] hover:text-white focus:outline-none">
                                {{-- Icono Ojo (SVG) --}}
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{-- Icono Ojo Tachado (SVG) --}}
                                <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        
                        @if($errors->has('password') && !str_contains($errors->first('password'), 'confirm'))
                            <p class="text-[#ef4444] !text-[12px] text-center mt-2 font-medium">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    {{-- 3. Confirmar Contraseña (Con botón personalizado) --}}
                    <div class="flex flex-col" x-data="{ show: false }">
                        <div class="relative w-full">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" placeholder="Confirmar contraseña" required
                                class="w-full bg-[#3B4B5B] text-white border-none rounded-full py-3 px-6 pr-12 focus:ring-2 focus:ring-[#02B48A] outline-none !text-[16px] placeholder:!text-[16px] transition-all">
                            
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
                        
                        @if($errors->has('password') && str_contains($errors->first('password'), 'confirm'))
                            <p class="text-[#ef4444] !text-[12px] text-center mt-2 font-medium">
                                Las contraseñas no coinciden.
                            </p>
                        @endif
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#02B48A] hover:bg-[#029A73] text-white font-bold py-3.5 rounded-full mt-4 transition-all shadow-lg active:scale-95 !text-[16px]">
                        {{ __('Registrar cuenta') }}
                    </button>
                </form>
            </div>

            <div class="mt-auto text-center pt-6 flex justify-between items-center px-2">
                <span class="text-[#94A3B8] !text-[14px]">{{ __('¿Ya tienes cuenta?') }}</span>
                <a href="{{ route('login') }}" class="text-white !text-[14px] font-semibold hover:underline transition-colors">
                    {{ __('Iniciar sesión') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts::auth.bare>