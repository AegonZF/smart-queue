<x-layouts::auth>
    {{-- Contenedor principal con el color exacto: #0a1a29 --}}
    <div class="bg-[#0a1a29] p-10 rounded-[2.5rem] shadow-2xl flex flex-col gap-8 border border-white/5 w-full max-w-[400px] mx-auto">
        
        <h2 class="text-center text-xl font-light text-white tracking-[0.2em]">
            {{ __('Crear cuenta') }}
        </h2>

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            {{-- 1. Correo --}}
            <div class="flex flex-col gap-1">
                <input type="email" name="email" placeholder="Correo" required value="{{ old('email') }}"
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white focus:ring-2 focus:ring-white/30 transition-all outline-none text-sm">
            </div>

            {{-- 2. Contraseña --}}
            <div class="flex flex-col gap-1">
                <input type="password" name="password" placeholder="Contraseña" required
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white focus:ring-2 focus:ring-white/30 transition-all outline-none text-sm">
            </div>

            {{-- 3. Confirmar Contraseña --}}
            <div class="flex flex-col gap-1">
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white focus:ring-2 focus:ring-white/30 transition-all outline-none text-sm">
            </div>

            {{-- Botón con el verde oscuro: #005954 --}}
            <button type="submit" 
                class="w-full bg-[#005954] hover:bg-[#00706a] text-white font-bold py-4 rounded-full mt-4 transition-all shadow-lg active:scale-95 uppercase tracking-wider">
                {{ __('Registrar cuenta') }}
            </button>
        </form>

        {{-- Footer del card --}}
        <div class="flex justify-between items-center text-xs mt-2 px-2">
            <span class="text-white/70 font-medium italic">{{ __('¿Ya tienes cuenta?') }}</span>
            <a href="{{ route('login') }}" class="text-white font-bold hover:underline transition-colors italic">
                {{ __('Iniciar sesión') }}
            </a>
        </div>
    </div>
</x-layouts::auth>