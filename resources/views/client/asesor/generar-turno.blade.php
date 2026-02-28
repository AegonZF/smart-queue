<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal: Azul #0C4D8B --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER CON COMPONENTE MODULAR --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Llamada al componente reutilizable --}}
            <x-user-dropdown />
        </header>

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">
            <h1 class="text-[26px] font-bold tracking-[0.2em] uppercase mb-12 text-center w-full">
                GENERA TURNO Y ESPERA
            </h1>

            @if(session('error'))
                <div class="bg-red-500/20 border border-red-400 text-red-100 px-6 py-3 rounded-xl mb-6 max-w-md w-full text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col gap-10 w-full max-w-xs items-center">
                {{-- Botón Generar --}}
                <form method="POST" action="{{ route('nova.turno.store') }}">
                    @csrf
                    <input type="hidden" name="service_type" value="asesor">
                    <input type="hidden" name="tramite" value="asesoria">
                    <button type="submit" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full h-32 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5" style="min-width: 280px;">
                        <span class="text-xl font-bold leading-tight text-white">
                            Generar <br> Turno
                        </span>
                    </button>
                </form>

                {{-- Botón Regresar --}}
                <a href="{{ route('nova.index') }}" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full h-32 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5 text-white">
                    <span class="text-xl font-bold">
                        Regresar
                    </span>
                </a>
            </div>
        </main>
    </div>
</x-nova>