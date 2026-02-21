<x-layouts::auth>
    <div class="bg-[#0a1a29] p-10 rounded-[2.5rem] shadow-2xl flex flex-col gap-8 border border-white/5">
        <h2 class="text-center text-xl font-light text-white tracking-[0.2em]">Bienvenido</h2>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div class="flex flex-col gap-1">
                <input type="email" name="email" placeholder="Correo" required
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white focus:ring-2 focus:ring-white/30 transition-all outline-none text-sm">
            </div>

            <div class="flex flex-col gap-1">
                <input type="password" name="password" placeholder="Contraseña" required
                    class="w-full bg-[#334155]/60 border-none rounded-full py-4 px-8 text-white placeholder-white focus:ring-2 focus:ring-white/30 transition-all outline-none text-sm">
                
                <div class="flex justify-end mt-2 pr-2">
                    <a href="{{ route('password.request') }}" class="text-white text-xs font-normal hover:underline transition-colors opacity-90 hover:opacity-100">
                        Recuperar contraseña
                    </a>
                </div>
            </div>

            <button type="submit" 
                class="w-full bg-[#005954] hover:bg-[#00706a] text-white font-bold py-4 rounded-full mt-4 transition-all shadow-lg active:scale-95">
                Iniciar sesión
            </button>
        </form>

        <div class="flex justify-between items-center text-xs mt-2 px-2">
            <span class="text-white/70 font-medium">¿No tienes cuenta?</span>
            <a href="{{ route('register') }}" class="text-white font-bold hover:underline transition-colors">
                Registrar cuenta
            </a>
        </div>
    </div>
</x-layouts::auth>