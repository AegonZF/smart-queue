<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal: Azul #0C4D8B --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">

        {{-- HEADER CON COMPONENTE --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Inclusión del componente modular --}}
            <x-user-dropdown />
        </header>

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">

            <div class="flex flex-col md:flex-row justify-between w-full max-w-5xl mb-24 gap-8">
                <div class="text-center md:text-left">
                    <h2 class="text-2xl md:text-3xl font-bold tracking-[0.1em] uppercase">
                        ASESOR ASIGNADO: <span class="font-normal text-blue-200">{{ $turn->serviceCounter->label }}</span>
                    </h2>
                </div>
                <div class="text-center md:text-right">
                    <h2 class="text-2xl md:text-3xl font-bold tracking-[0.1em] uppercase">
                        TURNO GENERADO: <span class="font-normal text-blue-200">{{ $turn->turn_number }}</span>
                    </h2>
                </div>
            </div>

            <div class="flex justify-center mb-20">
                {{-- Botón Cancelar: Rojo con el estilo Figma --}}
                <form method="POST" action="{{ route('nova.turno.cancel') }}">
                    @csrf
                    <button type="submit" class="bg-[#d3111b] hover:bg-[#b00e16] transition-all duration-200 rounded-[2.5rem] p-8 w-72 h-44 flex items-center justify-center text-center shadow-2xl hover:scale-105 active:scale-95 border border-white/10 group">
                        <span class="text-2xl font-bold leading-tight text-white group-hover:scale-110 transition-transform">
                            Cancelar <br> Turno
                        </span>
                    </button>
                </form>
            </div>

        </main>
    </div>
</x-nova>