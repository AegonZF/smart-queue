<x-nova>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Source+Sans+3:wght@400;500;600&display=swap');
    </style>

    <div class="fixed inset-0 w-full h-full overflow-y-auto bg-[#0C4D8B] font-['Source_Sans_3'] text-white z-50">
        
        {{-- Header alineado --}}
        <header class="flex justify-between items-center px-12 py-8 w-full">
            <div class="flex items-center">
                <img src="{{ asset('images/Logo_1.svg') }}" alt="NovaBank" class="w-[180px] h-auto">
            </div>

            <x-user-dropdown />
        </header>

        <main class="flex flex-col items-center justify-center mt-6 px-6 w-full">
            {{-- Título con espaciado amplio igual que el diseño --}}
            <h1 class="text-[28px] md:text-[36px] font-bold tracking-[0.25em] text-center uppercase mb-20 drop-shadow-md">
                TRÁMITE A REALIZAR
            </h1>

            <div class="flex flex-col md:flex-row gap-12 w-full max-w-5xl justify-center mb-10">
                {{-- Botón: Acudir a Ventanilla --}}
                <a href="{{ route('nova.ventanilla.tramite') }}" 
                   class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2.5rem] p-10 w-full md:w-[320px] h-56 flex items-center justify-center text-center shadow-2xl border border-white/10 group">
                    <span class="text-2xl font-bold leading-tight text-white group-hover:drop-shadow-lg">Acudir a <br> ventanilla</span>
                </a>

                {{-- Botón: Hablar con Asesor --}}
                <a href="{{ route('nova.asesor.generar') }}" 
                   class="bg-[#02B48A] hover:bg-[#029672] transition-all hover:scale-105 duration-300 rounded-[2.5rem] p-10 w-full md:w-[320px] h-56 flex items-center justify-center text-center shadow-2xl border border-white/10 group">
                    <span class="text-2xl font-bold leading-tight text-white group-hover:drop-shadow-lg">Hablar con <br> un Asesor</span>
                </a>
            </div>
        </main>
    </div>
</x-nova>