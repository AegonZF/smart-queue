<x-nova>
     <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;500;600;700&display=swap');
    </style>

    {{-- Contenedor principal: Fondo #0C4D8B --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER CON COMPONENTE MODULAR --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>

            {{-- Inclusión del componente oficial del cliente --}}
            <x-user-dropdown />
        </header>

        <main class="flex items-center justify-center px-6 min-h-[70vh]">
            {{-- LA TARJETA: Ajustada al color oficial #072b4e --}}
            <div class="bg-[#072b4e] rounded-[2.5rem] p-12 w-full max-w-5xl shadow-2xl flex items-center gap-12 border border-white/5">
                <div class="flex-1">
                    <h2 class="text-5xl font-bold mb-2 leading-tight">Cambiar contraseña</h2>
                    <p class="text-gray-300 mb-10 text-lg">Aquí puedes actualizar tu contraseña</p>
                    
                    <form class="space-y-6">
                        <div>
                            <label class="block text-xs mb-2 font-semibold uppercase tracking-wider">Nueva contraseña: <span class="text-red-500">*</span></label>
                            <input type="password" placeholder="Introduce tu contraseña" class="w-full bg-[#4D647C] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-400 outline-none focus:ring-2 focus:ring-[#007A7C] transition-all">
                        </div>
                        <div>
                            <label class="block text-xs mb-2 font-semibold uppercase tracking-wider">Confirma tu nueva contraseña: <span class="text-red-500">*</span></label>
                            <input type="password" placeholder="Confirma tu contraseña" class="w-full bg-[#4D647C] border-none rounded-2xl py-4 px-6 text-white placeholder-gray-400 outline-none focus:ring-2 focus:ring-[#007A7C] transition-all">
                        </div>
                        
                        <button type="submit" class="w-full bg-[#007A7C] hover:bg-[#005f61] transition-colors text-white font-bold py-4 rounded-2xl text-xl mt-4 shadow-lg active:scale-[0.98]">
                            Guardar cambios
                        </button>
                    </form>
                </div>

                {{-- Separador Visual --}}
                <div class="w-[1px] h-64 bg-white/10 hidden md:block"></div>

                {{-- Logo lateral decorativo --}}
                <div class="hidden md:flex flex-col items-center flex-1">
                    <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[350px] opacity-80">
                </div>
            </div>
        </main>
    </div>
</x-nova>