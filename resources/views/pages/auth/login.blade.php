<x-layouts::auth>
    <div class="bg-[#0a1a29] p-10 rounded-[2.5rem] shadow-2xl flex flex-col gap-8 border border-white/5 w-full max-w-[400px] mx-auto">
        <h2 class="text-center text-xl font-light text-white tracking-[0.2em] uppercase">
            Bienvenido
        </h2>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            {{-- Campo Correo --}}
            <div class="flex flex-col">
                <input type="email" name="email" placeholder="Correo" required 
                    value="{{ old('email') }}"
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white transition-all outline-none text-sm focus:ring-2 focus:ring-white/30">
            </div>

            {{-- Campo Contraseña --}}
            <div class="flex flex-col">
                <input type="password" name="password" placeholder="Contraseña" required
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white transition-all outline-none text-sm focus:ring-2 focus:ring-white/30">
                
                <div class="flex justify-end mt-2 pr-2">
                    <a href="{{ route('password.request') }}" class="text-white text-[10px] font-normal hover:underline opacity-80 italic">
                        Recuperar contraseña
                    </a>
                </div>
            </div>

            {{-- Mensaje de error en español arriba del botón --}}
            @if ($errors->any())
                <p class="text-red-500 text-[10px] italic text-center -mb-2 tracking-wide">
                    Correo o contraseña incorrecta.
                </p>
            @endif

            <button type="submit" 
                class="w-full bg-[#005954] hover:bg-[#00706a] text-white font-bold py-4 rounded-full mt-2 transition-all shadow-lg active:scale-95 uppercase tracking-wider">
                Iniciar sesión
            </button>
        </form>

        <div class="flex justify-between items-center text-[11px] mt-2 px-2">
            <span class="text-white/70 font-medium italic">¿No tienes cuenta?</span>
            <a href="{{ route('register') }}" class="text-white font-bold hover:underline transition-colors italic">
                Registrar cuenta
            </a>
        </div>
    </div>
</x-layouts::auth>