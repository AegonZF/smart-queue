<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;500;600;700&display=swap');
    </style>

    {{-- Contenedor principal: Fondo Azul #0C4D8B --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50 flex flex-col">
        
        {{-- HEADER CON COMPONENTE --}}
        <header class="flex justify-between items-center px-12 py-8 w-full shrink-0">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>

            {{-- Inclusión del componente modular --}}
            <x-user-dropdown />
        </header>

        <main class="flex-grow flex items-center justify-center px-6 pb-20 relative">
            
            {{-- LA TARJETA CENTRAL: Color #072b4e --}}
            <div class="bg-[#072b4e] rounded-[2.5rem] p-12 w-full max-w-5xl shadow-2xl flex flex-col md:flex-row items-center gap-16 border border-white/5 relative">
                
                {{-- Formulario de Perfil --}}
                <div class="flex-1 w-full">
                    <h2 class="text-5xl font-bold mb-1">Perfil</h2>
                    <p class="text-gray-300 mb-10 text-lg font-medium">Actualiza tu información</p>

                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        {{-- Campo: Nombre Completo --}}
                        <div>
                            <label class="block text-sm mb-2 font-medium">Nombre Completo: <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Introduce tu nombre completo" 
                                class="w-full bg-[#4D647C] border-none rounded-xl py-4 px-6 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-[#02B48A] transition-all">
                        </div>

                        {{-- Campo: Correo Electrónico --}}
                        <div>
                            <label class="block text-sm mb-2 font-medium">Correo electrónico: <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Introduce tu correo" 
                                class="w-full bg-[#4D647C] border-none rounded-xl py-4 px-6 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-[#02B48A] transition-all">
                        </div>

                        {{-- Botón: Guardar Cambios (Verde #02B48A) --}}
                        <div class="pt-4">
                            <button type="submit" 
                                class="w-full bg-[#02B48A] hover:bg-[#019875] text-white font-bold py-4 rounded-full transition-all text-xl shadow-lg active:scale-[0.98]">
                                Guardar cambios
                            </button>
                        </div>
                    </form>

                    {{-- Botón: Eliminar Cuenta (Rojo #B21321) --}}
                    <div class="mt-8">
                        <a href="{{ route('profile.delete') }}" 
                           class="inline-block bg-[#B21321] hover:bg-[#900f1a] text-white text-sm font-bold py-2 px-8 rounded-full transition-all shadow-md active:scale-95">
                            Eliminar Cuenta
                        </a>
                    </div>
                </div>

                {{-- Logo lateral derecho decorativo --}}
                <div class="hidden md:flex flex-col items-center flex-1">
                    <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[350px] opacity-90 select-none pointer-events-none">
                </div>
            </div>

            {{-- BOTÓN REGRESAR (Abajo a la derecha) --}}
            <div class="fixed bottom-10 right-12">
                <a href="{{ route('nova.index') }}" 
                   class="bg-[#02B48A] hover:bg-[#019875] text-white font-bold py-4 px-10 rounded-2xl text-xl shadow-2xl transition-all active:scale-95">
                    Regresar
                </a>
            </div>
        </main>
    </div>
</x-nova>