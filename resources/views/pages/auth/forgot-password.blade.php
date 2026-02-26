<x-layouts::auth.bare>
    {{-- Tipo grafia requerida para el diseño de la página de recuperación de contraseña. Se importan las fuentes 'Roboto' y 'Source Sans 3'  --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    <div class="min-h-screen flex flex-col items-center justify-start sm:justify-center bg-[#0C4D8B] z-50 font-['Source_Sans_3'] overflow-y-auto py-6 sm:py-10">
        
        {{-- SECCIÓN DEL LOGO ACTUALIZADA --}}
        <div class="mb-6 sm:mb-10 text-center flex flex-col items-center">
            {{-- Se ajustó a w-[220px] h-auto para logos horizontales estándar --}}
            <img 
                src="{{ asset('images/Logo_1.svg') }}" 
                alt="Logo NovaBank" 
                class="w-[140px] sm:w-[180px] md:w-[220px] h-auto object-contain"
            >
        </div>

        {{-- TARJETA PRINCIPAL CON DIMENSIONES (revisalo erick)--}}
        <div class="w-full max-w-[90vw] sm:max-w-[440px] min-h-0 sm:min-h-[540px] flex flex-col justify-between bg-[#072b4e] px-5 py-8 sm:px-10 sm:py-12 rounded-[1.5rem] shadow-2xl mx-4">
            
            {{-- Grupo Superior: Título y Formulario --}}
            <div class="w-full">
                <h2 class="font-['Roboto'] text-white text-center text-base sm:text-[1.15rem] font-normal mb-5 sm:mb-8 tracking-wide">
                    Recuperar contraseña
                </h2>

                <form method="POST" action="{{ route('password.email') }}" class="flex flex-col"
                    x-data="{
                        seconds: {{ session('status') ? 30 : 0 }},
                        counting: {{ session('status') ? 'true' : 'false' }},
                        get disabled() { return this.counting && this.seconds > 0 },
                        startCountdown() {
                            this.counting = true;
                            this.seconds = 30;
                            let interval = setInterval(() => {
                                this.seconds--;
                                if (this.seconds <= 0) {
                                    clearInterval(interval);
                                    this.counting = false;
                                }
                            }, 1000);
                        }
                    }"
                    x-init="if (counting) { startCountdown() }"
                >
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-center text-gray-300 text-[13px] mb-3">Email para recuperación</label>
                        
                        <input 
                            type="email" 
                            name="email"
                            placeholder="ejemplo@gmail.com"
                            value="{{ old('email') }}"
                            class="w-full bg-[#3B4B5B] text-white border-none rounded-lg py-3 px-4 focus:ring-2 focus:ring-[#02B48A] placeholder-gray-400 outline-none text-sm transition-all"
                            required
                            autofocus
                        >
                        
                        @error('email')
                            @if($message === __('passwords.throttled'))
                                {{-- Si es throttle, iniciar contador automáticamente --}}
                                <span class="text-amber-400 text-[12px] mt-2 block font-medium text-center"
                                    x-init="startCountdown()"
                                >
                                    <span x-show="seconds > 0">
                                        Por favor espera <span x-text="seconds" class="font-bold"></span>s antes de intentar de nuevo.
                                    </span>
                                    <span x-show="seconds <= 0" x-cloak class="text-[#4ade80]">
                                        Ya puedes intentar de nuevo.
                                    </span>
                                </span>
                            @else
                                <span class="text-[#ef4444] text-[12px] mt-2 block font-medium">{{ $message }}</span>
                            @endif
                        @enderror

                        @if (session('status'))
                            <span class="text-[#4ade80] text-[12px] mt-2 block font-medium text-center">
                                Correo de recuperación enviado
                            </span>
                            <span class="text-amber-400 text-[12px] mt-1 block font-medium text-center">
                                <span x-show="seconds > 0">
                                    Podrás reenviar en <span x-text="seconds" class="font-bold"></span>s
                                </span>
                                <span x-show="seconds <= 0" x-cloak class="text-[#4ade80]">
                                    Ya puedes reenviar el correo.
                                </span>
                            </span>
                        @endif
                    </div>

                    <button 
                        type="submit" 
                        :disabled="disabled"
                        :class="disabled ? 'bg-gray-500 cursor-not-allowed opacity-60' : 'bg-[#02B48A] hover:bg-[#029A73]'"
                        class="w-full text-white font-medium py-3 rounded-lg transition duration-200 text-sm mt-1"
                    >
                        Enviar
                    </button>
                </form>
            </div>

            {{-- Grupo Inferior: Enlace anclado al fondo --}}
            <div class="mt-auto text-center">
                <flux:link href="{{ route('login') }}" class="text-[#94A3B8] text-[12px] hover:text-white transition-colors decoration-none">
                    Regresar a inicio de sesión
                </flux:link>
            </div>
        </div>
    </div>
</x-layouts::auth.bare>