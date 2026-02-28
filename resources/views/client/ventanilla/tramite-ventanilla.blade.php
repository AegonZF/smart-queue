<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal con fondo azul sólido --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER UNIFICADO --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Inclusión del componente reutilizable --}}
            <x-user-dropdown />
        </header>

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center mt-4 px-6 w-full">
            <h1 class="text-[26px] font-bold tracking-[0.2em] uppercase mb-12 text-center w-full">
                Trámite en Ventanilla
            </h1>

            @if(session('error'))
                <div class="bg-red-500/20 border border-red-400 text-red-100 px-6 py-3 rounded-xl mb-6 max-w-2xl w-full text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-8 w-full max-w-4xl justify-center mb-10">
                {{-- Botón: Pago o Depósito --}}
                <form method="POST" action="{{ route('nova.turno.store') }}">
                    @csrf
                    <input type="hidden" name="service_type" value="ventanilla">
                    <input type="hidden" name="tramite" value="pago_deposito">
                    <button type="submit" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full md:w-64 h-44 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5">
                        <span class="text-xl font-bold leading-tight text-white">
                            Pago o <br> Depósito
                        </span>
                    </button>
                </form>

                {{-- Botón: Problema con Banca --}}
                <form method="POST" action="{{ route('nova.turno.store') }}">
                    @csrf
                    <input type="hidden" name="service_type" value="ventanilla">
                    <input type="hidden" name="tramite" value="problema_banca">
                    <button type="submit" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full md:w-64 h-44 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5">
                        <span class="text-xl font-bold leading-tight text-white">
                            Problema <br> con Banca
                        </span>
                    </button>
                </form>
            </div>

            {{-- Botón Regresar --}}
            <div class="w-full flex justify-center mt-4 mb-20">
                <a href="{{ route('nova.index') }}" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full md:w-64 h-32 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5 text-white">
                    <span class="text-xl font-bold">
                        Regresar
                    </span>
                </a>
            </div>
        </main>
    </div>
</x-nova>