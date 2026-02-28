<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER: Oficial de NovaBank --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="w-[50px] h-[50px] bg-[#3B82F6] rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-blue-600 transition-colors focus:outline-none">
                    <svg class="w-8 h-8 text-white mt-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </button>

                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-150" 
                     x-transition:enter-start="opacity-0 scale-95" 
                     x-transition:enter-end="opacity-100 scale-100" 
                     class="absolute right-0 mt-3 w-48 bg-[#072b4e] rounded-xl shadow-2xl border border-white/10 overflow-hidden z-50" 
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-white/10">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-gray-400 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-500/10 hover:text-red-400 transition-colors flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- CONTENIDO DEL ASESOR --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">
            
            {{-- Indicadores Superiores --}}
            <div class="flex flex-col md:flex-row justify-center w-full max-w-5xl mb-12 gap-12 md:gap-32">
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Ventanilla Asignada: <span class="font-normal opacity-90">1</span>
                    </h2>
                </div>
                <div class="text-center">
                    <h2 class="text-xl md:text-3xl font-bold tracking-tight">
                        Clientes por Atender: <span class="font-normal opacity-90">1</span>
                    </h2>
                </div>
            </div>

            {{-- Tiempo del turno (del Figma) --}}
            <div class="mb-16 text-center">
                <p class="text-lg md:text-xl font-medium tracking-wide">
                    Tiempo del turno actual : <span class="font-bold">15 Minutos</span>
                </p>
            </div>

            {{-- Botones de Acción con efecto 3D --}}
            <div class="flex flex-col md:flex-row gap-8 w-full max-w-4xl justify-center mb-20">
                <button class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#018d6c]">
                    <span class="text-2xl font-bold leading-tight">
                        Siguiente <br> Turno
                    </span>
                </button>

                <button class="bg-[#d3111b] hover:bg-[#b00e16] transition-all duration-200 rounded-[2rem] p-8 w-full md:w-72 h-44 flex items-center justify-center text-center shadow-xl hover:scale-105 active:scale-95 border-b-4 border-[#a30d15]">
                    <span class="text-2xl font-bold leading-tight">
                        Turno <br> Expirado
                    </span>
                </button>
            </div>

        </main>
    </div>
</x-nova>