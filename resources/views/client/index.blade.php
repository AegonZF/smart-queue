<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        

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
        <main class="flex flex-col items-center justify-center mt-10 px-6 w-full">
            <h1 class="text-[28px] md:text-[32px] font-bold tracking-[0.2em] text-center uppercase mb-16">
                TRÁMITE A REALIZAR
            </h1>

            <div class="flex flex-col md:flex-row gap-10 w-full max-w-4xl justify-center mb-20">
                <a href="{{ route('nova.ventanilla.tramite') }}" 
                   class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2rem] p-8 w-full md:w-72 h-52 flex items-center justify-center text-center shadow-xl border border-white/5">
                    <span class="text-xl font-bold leading-tight">Acudir a <br> ventanilla</span>
                </a>

                <a href="{{ route('nova.asesor.generar') }}" 
                   class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2rem] p-8 w-full md:w-72 h-52 flex items-center justify-center text-center shadow-xl border border-white/5">
                    <span class="text-xl font-bold leading-tight">Hablar con <br> un Asesor</span>
                </a>
            </div>
        </main>
    </div>
</x-nova>