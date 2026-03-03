<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    {{-- Contenedor principal --}}
    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- HEADER UNIFICADO --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div>
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[200px] h-auto">
            </div>
            
            {{-- Inclusión del componente modular --}}
            <x-user-dropdown />
        </header>

        {{-- Notificación slide-in de error --}}
        @if(session('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                class="fixed top-24 right-8 z-[100] flex items-center gap-4 bg-[#072b4e] text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/5 max-w-sm"
            >
                <span class="flex-shrink-0 bg-[#0f1c2e] rounded-xl p-2">
                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </span>
                <span class="font-bold text-base leading-snug">{{ session('error') }}</span>
            </div>
        @endif

        {{-- CONTENIDO CENTRAL --}}
        <main class="flex flex-col items-center justify-center mt-4 px-6 w-full min-h-[60vh]">
            <h1 class="text-[26px] font-bold tracking-[0.2em] uppercase mb-12 text-center w-full">
                GENERA TURNO Y ESPERA
            </h1>

            <div class="flex flex-col gap-10 w-full max-w-xs items-center">
                {{-- Botón Generar --}}
                <form method="POST" action="{{ route('nova.turno.store') }}">
                    @csrf
                    <input type="hidden" name="service_type" value="ventanilla">
                    <input type="hidden" name="tramite" value="general">
                    <button type="submit" class="bg-[#02B48A] hover:bg-[#029672] transition-all duration-200 rounded-[2rem] p-6 w-full h-32 flex items-center justify-center text-center shadow-lg hover:scale-105 active:scale-95 border border-white/5" style="min-width: 280px;">
                        <span class="text-xl font-bold text-white leading-tight">
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